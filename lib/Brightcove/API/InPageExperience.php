<?php

declare(strict_types=1);

namespace Brightcove\API;

use Brightcove\Item\InPageExperience\InPageExperience as InPageExperienceItem;
use Brightcove\Item\InPageExperience\InPageExperienceInterface as InPageExperienceItemInterface;
use Brightcove\Item\InPageExperience\InPageExperienceList;
use Brightcove\Item\InPageExperience\InPageExperienceListInterface;
use Brightcove\Item\ObjectInterface;
use Brightcove\Type\ApiType;
use Brightcove\Type\HttpMethod;
use Brightcove\Type\SortInterface;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * In-Page Experience API.
 */
final class InPageExperience extends API implements InPageExperienceInterface
{
    private const string API_BASE_PATH = '/experiences';

    /**
     * {@inheritdoc}
     */
    public function delete(string $id): void
    {
        $this->sendRequest(HttpMethod::Delete, self::API_BASE_PATH . '/' . $id, null);
    }

    /**
     * API request callback.
     *
     * @template Response
     *
     * @param HttpMethod $method
     *   HTTP method.
     * @param string $endpoint
     *   API endpoint
     * @param Response|class-string $result
     *    Response result.
     *
     * @return Response|Response[]|null
     *   Response object.
     *
     * @throws ClientExceptionInterface
     *   If the request is failed.
     */
    private function sendRequest(HttpMethod $method, string $endpoint, mixed $result): ObjectInterface|array|null
    {
        return $this->client->sendRequest(
            $method,
            self::API_VERSION,
            ApiType::InPageExperience,
            $this->account,
            $endpoint,
            $result,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $id): InPageExperienceItemInterface
    {
        return $this->sendRequest(HttpMethod::Get, self::API_BASE_PATH . '/' . $id, InPageExperienceItem::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(string $search = null, SortInterface $sort = null): InPageExperienceListInterface
    {
        $http_query = [];
        if ($search !== null) {
            $http_query['q'] = $search;
        }
        if ($sort !== null) {
            $http_query['sort'] = (string)$sort;
        }
        $http_query = http_build_query($http_query);

        return $this->sendRequest(
            HttpMethod::Get,
            self::API_BASE_PATH . (!empty($http_query) ? "?{$http_query}" : ''),
            InPageExperienceList::class,
        );
    }
}
