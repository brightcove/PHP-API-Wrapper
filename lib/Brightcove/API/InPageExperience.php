<?php

declare(strict_types=1);

namespace Brightcove\API;

use Brightcove\Item\InPageExperience\InPageExperience as InPageExperienceItem;
use Brightcove\Item\InPageExperience\InPageExperienceInterface as InPageExperienceItemInterface;
use Brightcove\Item\InPageExperience\InPageExperienceList;
use Brightcove\Item\InPageExperience\InPageExperienceListInterface;
use Brightcove\Item\ObjectInterface;
use Brightcove\Type\SortInterface;

/**
 * In-Page Experience API.
 */
final class InPageExperience extends API implements InPageExperienceInterface
{
    private const API_TYPE = 'experiences';
    private const API_BASE_PATH = '/experiences';

    /**
     * API request callback.
     *
     * @param string $method
     *   HTTP method.
     * @param string $endpoint
     *   API endpoint
     * @param string|null $result
     *   NULL to return the unmarshalled JSON, or a class name to deserialize
     *   into.
     *   This class must implement ObjectInterface.
     * @param ObjectInterface|null $post
     *   An ObjectInterface to post.
     *
     * @return ObjectInterface|ObjectInterface[]|null
     *   The given result based on $result.
     *
     * @throws \Brightcove\API\Exception\APIException
     */
    private function request(string $method, string $endpoint, ?string $result, $post = null)
    {
        return $this->client->request(
            $method,
            static::API_VERSION,
            static::API_TYPE,
            $this->account,
            $endpoint,
            $result,
            false,
            $post
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $id): void
    {
        $this->request('DELETE', static::API_BASE_PATH . '/' . $id, null);
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $id): InPageExperienceItemInterface
    {
        return $this->request('GET', static::API_BASE_PATH . '/' . $id, InPageExperienceItem::class);
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
            $http_query['sort'] = (string) $sort;
        }
        $http_query = http_build_query($http_query);

        return $this->request(
            'GET',
            static::API_BASE_PATH . (!empty($http_query) ? "?{$http_query}" : ''),
            InPageExperienceList::class
        );
    }
}
