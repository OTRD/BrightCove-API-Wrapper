<?php

namespace Brightcove\Test;

use Brightcove\API\Exception\APIException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;

class SearchTest extends TestBase
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
            $this->assertEquals($video->getName(), $created_video->getName());

            $videos[] = $created_video;
        }

        return $videos;
    }

    /**
     * @throws APIException
     */
    #[Depends('testCreateVideos')]
    public function testSearchVideos(array $videos): array
    {
        sleep(1);

        $name = $videos[0]->getName();

        for ($i = 0; $i < 300; $i++) {
            sleep(1);

            $search = 'name:"' . $name . '"';
            $found_videos = $this->cms->listVideos($search);

            if (count($found_videos) > 0) {
                break;
            }
        }

        $this->assertCount(1, $found_videos);
        $this->assertEquals($name, $found_videos[0]->getName());

        return $videos;
    }

    /**
     * @throws APIException
     */
    #[Depends('testSearchVideos')]
    #[DoesNotPerformAssertions]
    public function testCleanupVideos(array $videos): void
    {
        foreach ($videos as $video) {
            $this->cms->deleteVideo($video->getId());
        }
    }
}