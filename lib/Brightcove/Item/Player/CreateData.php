<?php

namespace Brightcove\Item\Player;

use Brightcove\Item\Player\Branch\Configuration\Configuration;

/**
 * @api
 */
class CreateData extends UpdateData
{
    protected Configuration $configuration;

    public function applyJSON(array $json): void
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'configuration', null, Configuration::class);
    }

    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }

    public function setConfiguration(Configuration $configuration): self
    {
        $this->configuration = $configuration;
        $this->fieldChanged('configuration');
        return $this;
    }
}
