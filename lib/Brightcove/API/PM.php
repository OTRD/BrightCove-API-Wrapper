<?php

namespace Brightcove\API;

use Brightcove\API\Exception\APIException;
use Brightcove\Item\ObjectInterface;
use Brightcove\Item\Player\Branch\Configuration\Configuration;
use Brightcove\Item\Player\CreateResult;
use Brightcove\Item\Player\Embed;
use Brightcove\Item\Player\EmbedList;
use Brightcove\Item\Player\Player;
use Brightcove\Item\Player\PlayerList;
use Brightcove\Item\Player\PublishComment;

/**
 * @api
 */
class PM extends API
{
    /**
     * @throws APIException
     */
    public function listPlayers(): ObjectInterface|PlayerList|null|array
    {
        return $this->pmRequest('GET', '/players', PlayerList::class);
    }

    /**
     * @throws APIException
     */
    public function createPlayer(Player $player): ObjectInterface|Player|null|array
    {
        return $this->pmRequest('POST', '/players', CreateResult::class, false, $player);
    }

    /**
     * @throws APIException
     */
    public function getPlayer(string $playerId): ObjectInterface|Player|null|array
    {
        return $this->pmRequest('GET', "/players/$playerId", Player::class);
    }

    /**
     * @throws APIException
     */
    public function updatePlayer(string $playerId, Player $player): ObjectInterface|array|null
    {
        return $this->pmRequest('PATCH', "/players/$playerId", CreateResult::class, false, $player);
    }

    /**
     * @throws APIException
     */
    public function deletePlayer(string $playerId): ObjectInterface|array|null
    {
        return $this->pmRequest('DELETE', "/players/$playerId", null);
    }

    /**
     * @param string $branch_name
     *   Must be "master" or "preview"
     * @throws APIException
     */
    public function getPlayerConfigurationBranch(string $playerId, string $branch_name): ObjectInterface|Configuration|array|null
    {
        return $this->pmRequest('GET', "/players/$playerId/configuration/$branch_name", Configuration::class);
    }

    /**
     * @throws APIException
     */
    public function updatePlayerConfigurationBranch(string $playerId, Configuration $config): ObjectInterface|CreateResult|array|null
    {
        return $this->pmRequest('PATCH', "/players/$playerId/configuration", CreateResult::class, false, $config);
    }

    /**
     * @throws APIException
     */
    public function publishPlayer(string $playerId, string $comment = ''): ObjectInterface|CreateResult|array|null
    {
        return $this->pmRequest('POST', "/players/$playerId/publish", CreateResult::class, false, (new PublishComment())->setComment($comment));
    }

    /**
     * @throws APIException
     */
    public function getEmbed(string $playerId, string $embedId): ObjectInterface|Embed|array|null
    {
        return $this->pmRequest('GET', "/players/$playerId/embeds/$embedId", Embed::class);
    }

    /**
     * @throws APIException
     */
    public function listEmbeds(string $playerId): ObjectInterface|EmbedList|array|null
    {
        return $this->pmRequest('GET', "/players/$playerId/embeds", EmbedList::class);
    }

    /**
     * @throws APIException
     */
    public function createEmbed(string $playerId, Configuration $data): ObjectInterface|Embed|array|null
    {
        return $this->pmRequest('POST', "/players/$playerId/embeds", Embed::class, false, $data);
    }

    /**
     * @throws APIException
     */
    public function publishEmbed(string $playerId, string $embedId, string $comment): ObjectInterface|Embed|array|null
    {
        return $this->pmRequest('POST', "/players/$playerId/embeds/$embedId/publish", Embed::class, false, (new PublishComment())->setComment($comment));
    }

    /**
     * @throws APIException
     */
    public function deleteEmbed(string $playerId, string $embedId): ObjectInterface|array|null
    {
        return $this->pmRequest('DELETE', "/players/$playerId/embeds/$embedId", null);
    }

    /**
     * @throws APIException
     */
    public function getEmbedConfigurationBranch(string $playerId, string $embedId, string $branch): ObjectInterface|Configuration|array|null
    {
        return $this->pmRequest('GET', "/players/$playerId/embeds/$embedId/$branch", Configuration::class);
    }

    /**
     * @throws APIException
     */
    public function updateEmbedConfigurationBranch(string $playerId, string $embedId, Configuration $configuration): ObjectInterface|Configuration|array|null
    {
        return $this->pmRequest('PATCH', "/players/$playerId/embeds/$embedId/configuration", Configuration::class, false, $configuration);
    }

    /**
     * @throws APIException
     */
    protected function pmRequest(string $method, string $endpoint, ?string $result, bool $isArray = false, ObjectInterface|null $post = null): ObjectInterface|array|null
    {
        return $this->client->request($method, '2', 'players', $this->account, $endpoint, $result, $isArray, $post);
    }

}
