<?php

declare(strict_types=1);

namespace Brightcove\Test;

use Brightcove\API\Exception\APIException;
use Brightcove\Item\Playlist;
use Brightcove\Item\Video\Video;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use Random\RandomException;

class PlaylistTest extends TestBase
{
    /**
     * @throws APIException
     */
    public function testCreateVideos(): array
    {
        $videos = [];

        for ($i = 0; $i < 10; $i++) {
            $video = $this->createRandomVideoObject();
            $created_video = $this->cms->createVideo($video);

            $this->assertNotNull($created_video->getId());

            $videos[] = $created_video;
        }

        return $videos;
    }

    /**
     * @throws RandomException
     * @throws APIException
     */
    #[Depends('testCreateVideos')]
    public function testCreatePlaylist(array $videos): array
    {
        $playlist = $this->createRandomPlaylistObject();
        $playlist->setType("EXPLICIT");
        $playlist->setName(self::generateRandomString(8));

        $name = $playlist->getName();

        $playlist = $this->cms->createPlaylist($playlist);

        $this->assertEquals($name, $playlist->getName());

        return [$playlist, $videos];
    }

    /**
     * @throws APIException
     */
    #[Depends('testCreatePlaylist')]
    public function testAddVideosToPlaylist(array $input): array
    {
        /** @var Playlist $playlist */
        $playlist = $input[0];
        /** @var Video[] $videos */
        $videos = $input[1];

        $videoIds = array_map(
            static fn(Video $video): string => $video->getId(),
            $videos
        );

        $playlist->setVideoIds($videoIds);

        $playlist = $this->cms->updatePlaylist($playlist);

        $this->assertEquals($videoIds, $playlist->getVideoIds());

        return [$playlist, $videos];
    }

    /**
     * @throws RandomException
     * @throws APIException
     */
    #[Depends('testAddVideosToPlaylist')]
    public function testUpdatePlaylist(array $input): array
    {
        /** @var Playlist $playlist */
        $playlist = $input[0];
        /** @var Video[] $videos */
        $videos = $input[1];

        $playlist->setDescription(self::generateRandomString(8));

        $description = $playlist->getDescription();

        $playlist = $this->cms->updatePlaylist($playlist);

        $this->assertEquals($description, $playlist->getDescription());

        return [$playlist, $videos];
    }

    /**
     * @throws APIException
     */
    #[Depends('testUpdatePlaylist')]
    public function testDeleteFromPlaylist(array $input): array
    {
        /** @var Playlist $playlist */
        $playlist = $input[0];
        /** @var Video[] $videos */
        $videos = $input[1];

        $playlist->setVideoIds([]);

        $playlist = $this->cms->updatePlaylist($playlist);

        $this->assertEquals([], $playlist->getVideoIds());

        return [$playlist, $videos];
    }

    /**
     * @throws APIException
     */
    #[Depends('testDeleteFromPlaylist')]
    #[DoesNotPerformAssertions]
    public function testDeleteVideos(array $input): Playlist
    {
        /** @var Playlist $playlist */
        $playlist = $input[0];
        /** @var Video[] $videos */
        $videos = $input[1];

        foreach ($videos as $video) {
            $this->cms->deleteVideo($video->getId());
        }

        return $playlist;
    }

    /**
     * @throws APIException
     */
    #[Depends('testDeleteVideos')]
    #[DoesNotPerformAssertions]
    public function testDeletePlaylist(Playlist $playlist): Playlist
    {
        $this->cms->deletePlaylist($playlist->getId());

        return $playlist;
    }

    /**
     * Searching for the deleted playlist in the remaining ones,
     * if the result is '0', the delete process was successful.
     *
     * @throws APIException
     */
    #[Depends('testDeletePlaylist')]
    public function testCheckDeletePlaylist(Playlist $playlist): void
    {
        $playlistId = $playlist->getId();

        $this->cms->deletePlaylist($playlistId);

        $playlistsList = $this->cms->listPlaylists();

        $match = 0;

        foreach ($playlistsList as $plist) {
            if ($plist->getId() === $playlistId) {
                $match++;
            }
        }

        $this->assertEquals(
            0,
            $match,
            "Playlist has been deleted successfully."
        );
    }
}