<?php

namespace Brightcove\API;

/**
 * A superclass for the Brightcove API implementations.
 */
abstract class API {
  protected $account;
  protected $client;

  /**
   * API constructor.
   *
   * @param \Brightcove\API\Client $client
   * @param $account
   */
  public function __construct(Client $client, $account) {
    $this->client = $client;
    $this->account = $account;
  }
}
