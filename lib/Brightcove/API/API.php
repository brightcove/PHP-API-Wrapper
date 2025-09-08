<?php

namespace Brightcove\API;

/**
 * A superclass for the Brightcove API implementations.
 *
 * @internal
 */
abstract class API
{
    /**
     * API's major version.
     */
    protected const string API_VERSION = '1';

    /**
     * Initializes an API handler.
     *
     * @param ApiClientInterface $client
     *   API client.
     * @param string $account
     *   Account ID.
     */
    public function __construct(
        protected ApiClientInterface $client,
        protected string $account,
    ) {}

    /**
     * Builds HTTP query parameters.
     *
     * @param array $query
     *   List of HTTP query parameters.
     *
     * @return string
     *   The built HTTP query.
     */
    protected function buildHttpQuery(array $query): string {
        $query_parameters = '';
        if ($query !== []) {
            $query_parameters = '?' . http_build_query($query);
        }
        return $query_parameters;
    }
}
