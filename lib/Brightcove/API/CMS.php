<?php

namespace Brightcove\API;

use Brightcove\API\Exception\APIException;
use Brightcove\API\Request\SubscriptionRequest;
use Brightcove\Item\CustomFields;
use Brightcove\Item\ObjectInterface;
use Brightcove\Item\Playlist;
use Brightcove\Item\Subscription;
use Brightcove\Item\Video\Images;
use Brightcove\Item\Video\Source;
use Brightcove\Item\Video\Video;

/**
 * @api
 */
class CMS extends API
{
    /**
     * @throws APIException
     */
    public function listVideos(?string $search = null, ?string $sort = null, ?int $limit = null, ?int $offset = null): array|ObjectInterface|null
    {
        $query = '';
        if ($search) {
            $query .= '&q=' . urlencode($search);
        }
        if ($sort) {
            $query .= '&sort=' . $sort;
        }
        if ($limit) {
            $query .= '&limit=' . $limit;
        }
        if ($offset) {
            $query .= '&offset=' . $offset;
        }
        if ($query) {
            $query = '?' . substr($query, 1);
        }
        return $this->cmsRequest('GET', '/videos' . $query, Video::class, true);
    }

    /**
     * @throws APIException
     */
    public function countVideos(?string $search = null): ?int
    {
        $query = $search === null ? '' : '?q=' . urlencode($search);
        /** @var array $result */
        $result = $this->cmsRequest('GET', '/counts/videos' . $query, null);
        if ($result && !empty($result['count'])) {
            return $result['count'];
        }
        return null;
    }

    /**
     * @throws APIException
     */
    public function getVideoImages(string $videoId): ObjectInterface|Images|array|null
    {
        return $this->cmsRequest('GET', '/videos/' . $videoId . '/images', Images::class);
    }

    /**
     * @throws APIException
     */
    public function getVideoSources(string $videoId): array|ObjectInterface|null
    {
        return $this->cmsRequest('GET', '/videos/' . $videoId . '/sources', Source::class, true);
    }

    /**
     * @throws APIException
     */
    public function getVideoFields(): ObjectInterface|array|null
    {
        return $this->cmsRequest('GET', '/video_fields', CustomFields::class);
    }

    /**
     * @throws APIException
     */
    public function getVideo(string $videoId): ObjectInterface|Video|array|null
    {
        return $this->cmsRequest('GET', '/videos/' . $videoId, Video::class);
    }

    /**
     * @throws APIException
     */
    public function createVideo(Video $video): ObjectInterface|Video|array|null
    {
        return $this->cmsRequest('POST', '/videos', Video::class, false, $video);
    }

    /**
     * @throws APIException
     */
    public function updateVideo(Video $video): ObjectInterface|Video|array|null
    {
        $video->fieldUnchanged('account_id', 'id');
        return $this->cmsRequest('PATCH', '/videos/' . $video->getId(), Video::class, false, $video);
    }

    /**
     * @throws APIException
     */
    public function deleteVideo(string $videoId): ObjectInterface|array|null
    {
        return $this->cmsRequest('DELETE', '/videos/' . $videoId, null);
    }

    /**
     * @throws APIException
     */
    public function countPlaylists(): ?int
    {
        /** @var array $result */
        $result = $this->cmsRequest('GET', '/counts/playlists', null);
        if ($result && !empty($result['count'])) {
            return $result['count'];
        }
        return null;
    }

    /**
     * @throws APIException
     */
    public function listPlaylists(?string $sort = null, ?int $limit = null, ?int $offset = null): ObjectInterface|array|null
    {
        $query = '';
        if ($sort) {
            $query .= '&sort=' . $sort;
        }
        if ($limit) {
            $query .= '&limit=' . $limit;
        }
        if ($offset) {
            $query .= '&offset=' . $offset;
        }
        if ($query) {
            $query = '?' . substr($query, 1);
        }
        return $this->cmsRequest('GET', '/playlists' . $query, Playlist::class, true);
    }

    /**
     * @throws APIException
     */
    public function createPlaylist(Playlist $playlist): ObjectInterface|Playlist|array|null
    {
        return $this->cmsRequest('POST', '/playlists', Playlist::class, false, $playlist);
    }

    /**
     * @throws APIException
     */
    public function getPlaylist(string $playlistId): ObjectInterface|Playlist|array|null
    {
        return $this->cmsRequest('GET', '/playlists/' . $playlistId, Playlist::class);
    }

    /**
     * @throws APIException
     */
    public function updatePlaylist(Playlist $playlist): ObjectInterface|Playlist|array|null
    {
        $playlist->fieldUnchanged('id');
        return $this->cmsRequest('PATCH', '/playlists/' . $playlist->getId(), Playlist::class, false, $playlist);
    }

    /**
     * @throws APIException
     */
    public function deletePlaylist(string $playlistId): void
    {
        $this->cmsRequest('DELETE', '/playlists/' . $playlistId, null);
    }

    /**
     * @throws APIException
     */
    public function getVideoCountInPlaylist(string $playlistId): ?int
    {
        /** @var array $result */
        $result = $this->cmsRequest('GET', '/counts/playlists/' . $playlistId . '/videos', null);
        if ($result && !empty($result['count'])) {
            return $result['count'];
        }
        return null;
    }

    /**
     * @throws APIException
     */
    public function getVideosInPlaylist(string $playlistId): ObjectInterface|array|null
    {
        return $this->cmsRequest('GET', '/playlists/' . $playlistId . '/videos', Video::class, true);
    }

    /**
     * @throws APIException
     */
    public function getSubscriptions(): ObjectInterface|array|null
    {
        return $this->cmsRequest('GET', '/subscriptions', Subscription::class, true);
    }

    /**
     * @throws APIException
     */
    public function getSubscription(string $subscriptionId): ObjectInterface|Subscription|array|null
    {
        return $this->cmsRequest('GET', '/subscriptions/' . $subscriptionId, Subscription::class);
    }

    /**
     * @throws APIException
     */
    public function createSubscription(SubscriptionRequest $request): ObjectInterface|Subscription|array|null
    {
        return $this->cmsRequest('POST', '/subscriptions', Subscription::class, false, $request);
    }

    /**
     * @throws APIException
     */
    public function deleteSubscription(string $subscriptionId): void
    {
        $this->cmsRequest('DELETE', '/subscriptions/' . $subscriptionId, null);
    }

    /**
     * @param int $limit between 1 and 100
     * @throws APIException
     */
    public function getVideosInFolder(string $folderId, int $limit = 20, int $page = 1): ObjectInterface|array|null
    {
        $offset = ($page - 1) * $limit;
        return $this->cmsRequest('GET', '/folders/' . $folderId . '/videos?limit=' . $limit . '&offset=' . $offset, Video::class, true);
    }

    /**
     * @throws APIException
     */
    public function addVideoToFolder(string $folderId, int $videoId): void
    {
        $this->cmsRequest('PUT', '/folders/' . $folderId . '/videos/' . $videoId, null);
    }

    /**
     * @throws APIException
     */
    protected function cmsRequest(string $method, string $endpoint, ?string $result, bool $isArray = false, ObjectInterface|null $post = null): ObjectInterface|array|null
    {
        return $this->client->request($method, '1', 'cms', $this->account, $endpoint, $result, $isArray, $post);
    }
}
