<?php

namespace Brightcove\Test;

use Brightcove\API\Client;
use Brightcove\API\CMS;
use Brightcove\API\DI;
use Brightcove\API\Exception\AuthenticationException;
use Brightcove\API\PM;
use Brightcove\Item\Playlist;
use Brightcove\Item\Video\Video;
use PHPUnit\Framework\TestCase;
use Random\RandomException;

class TestBase extends TestCase
{
    protected ?string $clientId = null;

    protected ?string $clientSecret = null;

    protected ?string $accountId = null;

    /**
     * A local address on which a PHP webserver can be started.
     *
     * @see waitForHTTPCallback()
     * @see startServer()
     */
    protected string $callbackHost;

    /**
     * A remote address which could be used for HTTP callbacks.
     *
     * @see waitForHTTPCallback()
     */
    protected string $callbackAddrRemote;

    protected Client $client;

    protected CMS $cms;

    protected DI $di;

    protected PM $pm;

    /**
     * @throws RandomException
     */
    public static function generateRandomString(int $length = 16): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * @param int $timeout Timeout in seconds.
     * @return string Response body.
     */
    public static function waitForHTTPCallback(string $host, int $timeout = 300): string
    {
        self::startServer($host, 'server.lock');

        while (!self::checkFile() && $timeout > 0) {
            sleep(1);
            $timeout--;
        }

        $answer = file_exists('server_out.txt')
            ? (string)file_get_contents('server_out.txt')
            : '';

        self::stopServer('server.lock');

        return $answer;
    }

    private static function checkFile(): bool
    {
        clearstatcache();

        return file_exists('server_out.txt') && filesize('server_out.txt') > 0;
    }

    /**
     * @param string $host    Host to listen on.
     * @param string $pidFile PID file used to track the process.
     */
    private static function startServer(string $host, string $pidFile): void
    {
        $cmd = "php -S $host router.php";
        $outputFile = 'server_out.txt';

        shell_exec(sprintf('%s > %s 2>&1 & echo $! >> %s', $cmd, $outputFile, $pidFile));

        sleep(1);
    }

    /**
     * @param string $pidFile PID file containing process IDs.
     */
    private static function stopServer(string $pidFile): void
    {
        if (file_exists($pidFile)) {
            $pids = file($pidFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            if ($pids !== false) {
                foreach ($pids as $pid) {
                    shell_exec('kill -9 ' . escapeshellarg($pid));
                }
            }

            unlink($pidFile);
        }

        if (file_exists('server_out.txt')) {
            unlink('server_out.txt');
        }
    }

    /**
     * @throws AuthenticationException
     */
    protected function getClient(): Client
    {
        return Client::authorize($this->clientId, $this->clientSecret);
    }

    /**
     * @throws AuthenticationException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $json = file_get_contents('config.json');

        if ($json) {
            $config = json_decode($json, true);

            if (is_array($config)) {
                foreach ($config as $k => $v) {
                    $this->{$k} = $v;
                }
            }
        }

        $this->client = $this->getClient();
        $this->cms = $this->createCMSObject($this->client);
        $this->di = $this->createDIObject($this->client);
        $this->pm = $this->createPMObject($this->client);
    }

    /**
     * @param Client|null $client The $client instance to use. If NULL, then the client of this class will be used.
     * @throws AuthenticationException
     */
    protected function createCMSObject(?Client $client = null): CMS
    {
        if ($client === null) {
            $client = $this->getClient();
        }

        return new CMS($client, $this->accountId);
    }

    /**
     * @param Client|null $client The $client instance to use. If NULL, then the client of this class will be used.
     * @throws AuthenticationException
     */
    protected function createDIObject(?Client $client = null): DI
    {
        if ($client === null) {
            $client = $this->getClient();
        }

        return new DI($client, $this->accountId);
    }

    /**
     * @param Client|null $client The $client instance to use. If NULL, then the client of this class will be used.
     * @throws AuthenticationException
     */
    protected function createPMObject(?Client $client = null): PM
    {
        if ($client === null) {
            $client = $this->getClient();
        }

        return new PM($client, $this->accountId);
    }

    protected function createRandomVideoObject(): Video
    {
        $video = new Video();
        $video->setName(uniqid('brightcove_api_test_', true));

        return $video;
    }

    protected function createRandomPlaylistObject(): Playlist
    {
        $playlist = new Playlist();
        $playlist->setName(uniqid('brightcove_api_test_', true));

        return $playlist;
    }
}