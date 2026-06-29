<?php

namespace Brightcove\Test;

use Brightcove\API\Exception\AuthenticationException;

class Test extends TestBase
{
    public function testHasClientData(): void
    {
        $this->assertTrue((bool)$this->clientId, 'Client ID exists');
        $this->assertTrue((bool)$this->clientSecret, 'Client secret exists');
        $this->assertTrue((bool)$this->accountId, 'Account exists');
    }

    /**
     * @throws AuthenticationException
     */
    public function testAuthorization(): void
    {
        $client = $this->getClient();
        $this->assertTrue($client->isAuthorized(), 'Client is authorized');
    }
}
