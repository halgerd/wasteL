<?php

namespace App\Models;

use GuzzleHttp\ClientInterface;
use Jenssegers\Model\Model;
use Psr\Http\Client\RequestExceptionInterface;

class Brewery extends Model
{
    /**
     * @var ClientInterface
     */
    private static $client;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function setClient(ClientInterface $httpClient): void
    {
        self::$client = $httpClient;
    }

    /**
     * @return Brewery|void
     */
    public static function find(int $id)
    {
        try {
            $response = self::$client->request('GET', 'breweries/' . $id);
        } catch (RequestExceptionInterface $e) {
            return abort($e->getCode(), $e->getMessage());
        }

        $instance = new static;

        return $instance->newInstance(json_decode($response->getBody(), true));
    }

    /**
     * @return array|void
     */
    public static function all(int $limit, int $page = 1): array
    {
        try {
            $response = self::$client->request('GET', "breweries/?per_page={$limit}&page={$page}");
        } catch (RequestExceptionInterface $e) {
            return abort($e->getCode(), $e->getMessage());
        }

        return self::hydrate(json_decode($response->getBody(), true));
    }
}
