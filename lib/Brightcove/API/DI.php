<?php

namespace Brightcove\API;

use Brightcove\API\Exception\APIException;
use Brightcove\API\Request\IngestRequest;
use Brightcove\API\Response\IngestResponse;
use Brightcove\Item\ObjectInterface;

/**
 * @api
 */
class DI extends API
{
    /**
     * @throws APIException
     */
    public function createIngest(string $videoId, IngestRequest $request): ObjectInterface|IngestResponse|array|null
    {
        return $this->diRequest('POST', '/videos/' . $videoId . '/ingest-requests', IngestResponse::class, false, $request);
    }

    /**
     * @throws APIException
     */
    protected function diRequest(string $method, string $endPoint, ?string $result, bool $isArray = false, ObjectInterface|null $post = null): ObjectInterface|array|null
    {
        return $this->client->request($method, '1', 'ingestion', $this->account, $endPoint, $result, $isArray, $post);
    }
}
