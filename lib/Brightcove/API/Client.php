<?php

namespace Brightcove\API;

use Brightcove\API\Exception\APIException;
use Brightcove\API\Exception\AuthenticationException;
use Brightcove\Constants;
use Brightcove\Item\ObjectInterface;
use CurlHandle;

class Client
{
    public static ?string $debugRequests = null;

    public static bool $retry = false;

    public static ?bool $httpProxyTunnel = null;

    public static ?int $proxyAuth = null;

    public static ?int $proxyPort = null;

    public static ?int $proxyType = null;

    public static ?string $proxy = null;

    public static ?string $proxyUserPassword = null;

    public static ?string $consumer = null;

    protected string $accessToken;

    protected int $expiresIn;

    public function __construct(string $accessToken, int $expiresIn = 0)
    {
        $this->accessToken = $accessToken;
        $this->expiresIn = $expiresIn;
    }

    /**
     * @param null|callable $extraConfig
     *   A callback to set extra options on curl. This callback takes one argument,
     *   which is a curl resource and returns nothing.
     * @return array
     *   A two item array. The first item is the status code, the second is the
     *   response body.
     */
    public static function HTTPRequest(string $method, string $url, array $headers = [], string $postData = null, callable $extraConfig = null): array
    {
        $ch = curl_init();

        if ($postData !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            $headers[] = 'Content-Type: application/json';
        }

        curl_setopt_array($ch, [
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SAFE_UPLOAD    => true,
            CURLOPT_MAXREDIRS      => 5,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_URL            => $url,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_HEADER         => true,
            CURLINFO_HEADER_OUT    => (bool)self::$debugRequests,
        ]);

        self::configureProxy($ch);

        if (static::$consumer) {
            /** @var non-empty-string $userAgent */
            $userAgent = static::getUserAgent();
            curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        }

        if ($extraConfig !== null) {
            $extraConfig($ch);
        }

        /** @var string $rawResult */
        $rawResult = curl_exec($ch) ?: '';
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $resHeaders = substr($rawResult, 0, $headerSize);
        $result = substr($rawResult, $headerSize);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (self::$debugRequests) {
            file_put_contents(self::$debugRequests, var_export([
                    'request'          => curl_getinfo($ch, CURLINFO_HEADER_OUT),
                    'request_body'     => $postData,
                    'response'         => [$code, $result],
                    'response_headers' => $resHeaders,
                ], true) . "\n\n", FILE_APPEND);
        }

        curl_close($ch);

        return [$code, $result];
    }

    /**
     * @throws AuthenticationException
     */
    public static function authorize(string $clientId, string $clientSecret): self
    {
        [$code, $response] = self::HTTPRequest(
            'POST',
            'https://oauth.brightcove.com/v3/access_token',
            ['Content-Type: application/x-www-form-urlencoded'],
            'grant_type=client_credentials',
            static function ($ch) use ($clientId, $clientSecret) {
                curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$clientSecret");
            }
        );

        if ($code !== 200) {
            throw new AuthenticationException('Authorization failed: ' . $response . '.');
        }

        $json = json_decode($response, true);
        if ($json['token_type'] !== 'Bearer') {
            throw new AuthenticationException('Unsupported token type: ' . $json['token_type']);
        }

        return new Client($json['access_token'], $json['expires_in']);
    }

    protected static function configureProxy(CurlHandle $ch): void
    {
        if (self::$httpProxyTunnel) {
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, self::$httpProxyTunnel);
        }
        if (self::$proxyAuth) {
            curl_setopt($ch, CURLOPT_PROXYAUTH, self::$proxyAuth);
        }
        if (self::$proxyPort) {
            curl_setopt($ch, CURLOPT_PROXYPORT, self::$proxyPort);
        }
        if (self::$proxyType) {
            curl_setopt($ch, CURLOPT_PROXYTYPE, self::$proxyType);
        }
        if (self::$proxy) {
            curl_setopt($ch, CURLOPT_PROXY, self::$proxy);
        }
        if (self::$proxyUserPassword) {
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, self::$proxyUserPassword);
        }
    }

    protected static function getUserAgent(): string
    {
        $apiWrapperVersion = Constants::VERSION;
        $consumer = static::$consumer;
        $host = $_SERVER['HTTP_HOST'] ?: gethostname();
        $software = $_SERVER['SERVER_SOFTWARE'];
        $curlVersion = curl_version();
        $version = $curlVersion ? $curlVersion['version'] : '';
        return "PHP-API-Wrapper/$apiWrapperVersion ($host; $software curl/$version) $consumer";
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * This value might not be correct. The object stores the response
     * from Brightcove, but it does not adjust it as the time passes.
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * This usually means that the client is authorized, but not necessarily.
     */
    public function isAuthorized(): bool
    {
        return (bool)$this->getAccessToken();
    }

    /**
     * @throws APIException
     */
    public function request(string $method, string $apiVersion, string $apiType, string $account, string $endpoint, ?string $result, bool $isArray = false, ObjectInterface|null $post = null): ObjectInterface|array|null
    {
        $body = null;
        if ($post) {
            if ($method === 'PATCH') {
                $body = $post->patchJSON();
            } else {
                $body = $post->postJSON();
            }
            $body = json_encode($body);
        }

        $totalRequests = 0;
        do {
            [$code, $res] = self::HTTPRequest(
                $method,
                "https://$apiType.api.brightcove.com/v$apiVersion/accounts/$account$endpoint",
                ["Authorization: Bearer $this->accessToken"],
                $body ?: null
            );
        }
        // Automatically request again if we hit the rate limit. In between, though,
        // wait for 2 seconds, just to be 100% sure.
        // Read on https://docs.brightcove.com/en/video-cloud/cms-api/getting-started/overview-cms.html
        // for more information about the rate limiting.
        // We also provide a check to not run into an infinite loop.
        while (static::$retry && $totalRequests++ < 10 && $code === 429 && sleep(2));

        if ($code < 200 || $code >= 300) {
            throw new APIException("Invalid status code: expected 200-299, got $code.\n\n$res", $code, null, $res);
        }

        $json = json_decode($res, true);

        if ($result === null) {
            return $json;
        }

        /** @var class-string<ObjectInterface> $result */
        if ($isArray) {
            $ret = [];
            foreach ($json as $item) {
                $ret[] = call_user_func([$result, 'fromJSON'], $item);
            }
            return $ret;
        }

        return call_user_func([$result, 'fromJSON'], $json);
    }
}
