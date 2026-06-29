<?php

namespace Brightcove\Test;

use Brightcove\API\Exception\APIException;
use Brightcove\Item\Playlist;
use Brightcove\Item\Video\Video;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use Random\RandomException;

class SmartPlaylistTest extends TestBase
{
    /**
     * Creates an array[10] filling it up with random video objects
     * and sets the Tag field with a random string.
     *
     * @throws RandomException
     */
    public function testCreateVideos(): array
    {
        $videos = [];
        $videoTag[0] = self::generateRandomString(8);

        for ($i = 0; $i < 10; $i++) {
            $video = $this->createRandomVideoObject();
            $video->setTags($videoTag);

            $created_video = $this->cms->createVideo($video);

            $this->assertNotNull($created_video->getId());

            $videos[] = $created_video;
        }

        return $videos;
    }

    /**
     * @throws RandomException|APIException
     */
    #[Depends('testCreateVideos')]
    public function testCreatePlaylist(array $videos): array
    {
        $playlist = $this->createRandomPlaylistObject();
        $playlist->setType("ALPHABETICAL");
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
    public function testSetSearchToPlaylist(array $input): array
    {
        /** @var Playlist $playlist */
        $playlist = $input[0];
        /** @var Video[] $videos */
        $videos = $input[1];

        $videoTag = $videos[0]->getTags();

        $playlist->setSearch('+tags:"' . $videoTag[0] . '"');

        $search = $playlist->getSearch();

        $playlist = $this->cms->updatePlaylist($playlist);

        $this->assertEquals($search, $playlist->getSearch());

        return [$playlist, $videos];
    }

    /**
     * @throws APIException
     */
    #[Depends('testSetSearchToPlaylist')]
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
     * @throws RandomException
     * @throws APIException
     */
    #[Depends('testDeleteVideos')]
    public function testSetDescriptionToPlaylist(Playlist $playlist): Playlist
    {
        $playlist->setDescription(self::generateRandomString(18));

        $description = $playlist->getDescription();

        $playlist = $this->cms->updatePlaylist($playlist);

        $this->assertEquals($description, $playlist->getDescription());

        return $playlist;
    }

    /**
     * @throws APIException
     */
    #[Depends('testSetDescriptionToPlaylist')]
    #[DoesNotPerformAssertions]
    public function testDeletePlaylist(Playlist $playlist): Playlist
    {
        $this->cms->deletePlaylist($playlist->getId());

        return $playlist;
    }

    /**
     * Searching for the deleted SmartPlaylist in the remaining ones,
     * if the result is '0', the delete process was successful.
     *
     * @throws APIException
     */
    #[Depends('testDeletePlaylist')]
    public function testCheckDeletePlaylist(Playlist $playlist): void
    {
        $playlist_id = $playlist->getId();

        $this->cms->deletePlaylist($playlist_id);

        $playlistsList = $this->cms->listPlaylists();

        $match = 0;

        foreach ($playlistsList as $plist) {
            if ($plist->getId() === $playlist_id) {
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