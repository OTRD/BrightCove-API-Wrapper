<?php

namespace Brightcove\Test;

use Brightcove\API\Exception\APIException;
use Brightcove\Item\Video\CuePoint;
use Brightcove\Item\Video\Link;
use Brightcove\Item\Video\Sharing;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use Random\RandomException;

class VideoCRUDTest extends TestBase
{
    /**
     * @throws APIException
     */
    public function testVideoObjectCreation(): string
    {
        $video = $this->createRandomVideoObject();

        $video = $this->cms->createVideo($video);
        $this->assertNotEmpty($video->getId(), 'Video id is not empty');

        return $video->getId();
    }

    /**
     * TODO: This test is not working. Need to fix it when we figure out what profile to use for ingestion.
     *
     * @throws APIException
     *
     * #[Depends('testVideoObjectCreation')]
     * public function testVideoIngestion(string $videoId): string
     * {
     * $request = IngestRequest::createRequest(
     * 'http://download.blender.org/peach/bigbuckbunny_movies/big_buck_bunny_480p_surround-fix.avi',
     * 'high-bandwidth-devices'
     * );
     *
     * if (!empty($this->callbackAddrRemote)) {
     * $request->setCallbacks([$this->callbackAddrRemote]);
     * }
     *
     * $ingest = $this->di->createIngest($videoId, $request);
     * $this->assertNotEmpty($ingest->getId());
     *
     * return $videoId;
     * }
     *
     * #[Depends('testVideoIngestion')]
     * public function testVideoIngestionCallback(string $videoId): string
     * {
     * if (empty($this->callbackHost)) {
     * $this->markTestSkipped();
     * }
     *
     * $json = self::waitForHTTPCallback($this->callbackHost);
     * $this->assertNotEmpty($json, 'Callback result');
     *
     * $result = json_decode($json, true);
     * $this->assertNotEmpty($result, 'The result is correct JSON');
     * $this->assertEquals('SUCCESS', $result['status']);
     *
     * return $videoId;
     * }
     */

    /**
     * @throws APIException
     */
    #[Depends('testVideoObjectCreation')]
    public function testVideoRetrieving(string $videoId): string
    {
        $video = $this->cms->getVideo($videoId);

        $this->assertNotEmpty($video->getId(), 'Video ID is not empty');
        $this->assertEquals($videoId, $video->getId(), 'Returned video id is the same');

        return $videoId;
    }

    /**
     * @throws RandomException
     * @throws APIException
     */
    #[Depends('testVideoRetrieving')]
    public function testVideoUpdating(string $videoId): string
    {
        $video = $this->cms->getVideo($videoId);

        $name = self::generateRandomString();
        $video->setName($name);

        $description = self::generateRandomString();
        $video->setDescription($description);

        $longDescription = self::generateRandomString();
        $video->setLongDescription($longDescription);

        $cuePoint = new CuePoint();

        $cueName = self::generateRandomString();
        $cuePoint->setName($cueName);

        $type = 'AD';
        $cuePoint->setType($type);

        $time = 0.0;
        $cuePoint->setTime($time);

        $cuePoint->setForceStop(false);

        $video->setCuePoints([$cuePoint]);

        $tags = [
            strtolower(self::generateRandomString(5)),
            strtolower(self::generateRandomString(5)),
            strtolower(self::generateRandomString(5)),
            strtolower(self::generateRandomString(5)),
            strtolower(self::generateRandomString(5)),
        ];

        sort($tags);
        $video->setTags($tags);

        $url = self::generateRandomString();
        $text = self::generateRandomString();

        $link = new Link();
        $link->setText($text);
        $link->setUrl($url);

        $video->setLink($link);

        $byId = $this->accountId;

        $sharing = new Sharing();
        $sharing->setByExternalAcct(true);
        $sharing->setById($byId);
        $sharing->setToExternalAcct(true);
        $sharing->setByReference(true);

        $video->setSharing($sharing);

        $result = $this->cms->updateVideo($video);

        $this->assertEquals($videoId, $result->getId(), 'Video IDs should be equals');
        $this->assertEquals($name, $result->getName(), 'Names should be updated');
        $this->assertEquals($description, $result->getDescription(), 'Description should be updated');
        $this->assertEquals([$cuePoint], $result->getCuePoints(), 'CuePoints should be updated');
        $this->assertEquals($cueName, $result->getCuePoints()[0]->getName(), 'Cue Names should be updated');
        $this->assertEquals($time, $result->getCuePoints()[0]->getTime(), 'Times should be updated');
        $this->assertFalse($result->getCuePoints()[0]->getForceStop(), 'Force should be updated');
        $this->assertEquals($url, $result->getLink()->getUrl(), 'The link object`s URL field should be updated');
        $this->assertEquals($text, $result->getLink()->getText(), 'The link object`s Text field should be updated');
        $this->assertTrue($result->getSharing()->getByExternalAcct(), 'The sharing object`s by_external field should be updated');
        $this->assertEquals($byId, $result->getSharing()->getById(), 'The sharing object`s by_id field should be updated');
        $this->assertTrue($result->getSharing()->getToExternalAcct(), 'The sharing object`s to_external_acct field should be updated');
        $this->assertTrue($result->getSharing()->getByReference(), 'The sharing object`s by_reference field should be updated');

        $newTags = $result->getTags();
        sort($newTags);

        $this->assertEquals($tags, $newTags, 'Tags should be updated');

        $sharing = new Sharing();
        $sharing->setByExternalAcct(false);
        $sharing->setById($byId);
        $sharing->setToExternalAcct(false);
        $sharing->setByReference(true);
        $result->setSharing($sharing);
        $this->cms->updateVideo($result);
        return $videoId;
    }

    /**
     * @throws APIException
     */
    #[Depends('testVideoUpdating')]
    #[DoesNotPerformAssertions]
    public function testVideoDeleting(string $videoId): void
    {
        $this->cms->deleteVideo($videoId);
    }
}