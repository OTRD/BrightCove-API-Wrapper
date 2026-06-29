<?php
declare(strict_types=1);

namespace Brightcove\Test;

use Brightcove\API\Exception\APIException;
use Brightcove\Item\ObjectInterface;
use Brightcove\Item\Player\Branch\Configuration\Media;
use Brightcove\Item\Player\Player;
use PHPUnit\Framework\Attributes\Depends;
use Random\RandomException;

const BRIGHTCOVE_PLAYER_TEST_POSTER = 'https://upload.wikimedia.org/wikipedia/commons/c/c4/PM5544_with_non-PAL_signals.png';

class PMTest extends TestBase
{
    /**
     * @throws RandomException
     * @throws APIException
     */
    public function testPlayerCreation(): ?Player
    {
        $player = new Player();
        $player->setName(self::generateRandomString());

        $result = $this->pm->createPlayer($player);

        $this->assertNotEmpty($result);
        $this->assertNotEmpty($result->getId());

        return $this->pm->getPlayer($result->getId());
    }

    #[Depends('testPlayerCreation')]
    public function testCheckPlayer(Player $player): ?Player
    {
        $playerID = $player->getId();
        $playerList = $this->pm->listPlayers();

        $match = 0;
        foreach ($playerList->getItems() as $p) {
            if ($p->getId() === $playerID) {
                $match++;
            }
        }

        $this->assertEquals(1, $match, 'Player found.');

        return $player;
    }

    /**
     * @throws RandomException
     * @throws APIException
     */
    #[Depends('testCheckPlayer')]
    public function testUpdatePlayer(Player $player): ObjectInterface|Player
    {
        $desc = self::generateRandomString(64);
        $player->setDescription($desc);
        $playerId = $player->getId();
        $this->pm->updatePlayer($playerId, $player);
        $player = $this->pm->getPlayer($playerId);

        $this->assertEquals($desc, $player->getDescription(), "Player description has been updated successfully");

        return $player;
    }

    #[Depends('testUpdatePlayer')]
    public function testUpdateAndPublishConfiguration(Player $player): ObjectInterface|Player
    {
        $master = $player->getBranches()->getMaster()->getConfiguration();
        $posterConf = ['highres' => BRIGHTCOVE_PLAYER_TEST_POSTER];

        $master->setMedia((new Media())->setPoster($posterConf));
        $this->pm->updatePlayerConfigurationBranch($player->getId(), $master);

        $player = $this->pm->getPlayer($player->getId());
        $this->assertEquals(
            $posterConf,
            $player->getBranches()->getPreview()->getConfiguration()->getMedia()->getPoster()
        );

        $this->pm->publishPlayer($player->getId());
        $player = $this->pm->getPlayer($player->getId());

        $this->assertEquals(
            $posterConf,
            $player->getBranches()->getMaster()->getConfiguration()->getMedia()->getPoster()
        );

        return $player;
    }

    #[Depends('testUpdateAndPublishConfiguration')]
    public function testDeletePlayer(Player $player): void
    {
        $playerId = $player->getId();
        $this->pm->deletePlayer($playerId);

        $playerList = $this->pm->listPlayers();
        $match = 0;

        foreach ($playerList->getItems() as $p) {
            if ($p->getId() === $playerId) {
                $match++;
            }
        }

        $this->assertEquals(0, $match, "Player has been deleted successfully.");
    }
}