<?php

namespace Brightcove\API;

use Brightcove\API\ApiBase;
use Brightcove\API\Request\IngestRequest;
use Brightcove\API\Response\IngestResponse;
use Brightcove\Type\ApiType;

/**
 * Class DI
 *
 * @package Brightcove\API
 * @api
 */
class DI extends API {

  protected function diRequest($method, $endpoint, $result, $is_array = FALSE, $post = NULL) {
    return $this->client->sendRequest($method, self::API_VERSION, ApiType::DynamicIngest, $this->account, $endpoint, $result, $is_array, $post);
  }

  /**
   * @return IngestResponse
   */
  public function createIngest($video_id, IngestRequest $request) {
    return $this->diRequest('POST', "/videos/{$video_id}/ingest-requests", IngestResponse::class, FALSE, $request);
  }
}
