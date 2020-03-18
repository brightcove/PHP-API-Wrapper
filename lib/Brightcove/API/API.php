<?php

namespace Brightcove\API;

/**
 * A superclass for the Brightcove API implementations.
 *
 * @internal
 */
abstract class API {
  protected $account;
  protected $client;

  /**
   * API constructor.
   *
   * @param \Brightcove\API\Client $client
   * @param $account
   *
   * @internal
   */
  public function __construct(Client $client, $account) {
    $this->client = $client;
    $this->account = $account;
  }

  /**
   * Formats search terms.
   *
   * @return string
   *   Basic search tearms formatted (e.g ?q=tag:example)
   */
  protected function formatSearchTerms($search = NULL, $sort = NULL, $limit = NULL, $offset = NULL) {
    $query = '';
    if ($search) {
      $query .= '&q=' . urlencode($search);
    }
    if ($sort) {
      $query .= "&sort={$sort}";
    }
    if ($limit) {
      $query .= "&limit={$limit}";
    }
    if ($offset) {
      $query .= "&offset={$offset}";
    }
    if (strlen($query) > 0) {
      $query = '?' . substr($query, 1);
    }

    return $query;
  }

}
