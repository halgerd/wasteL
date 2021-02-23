<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paginated;
use App\Http\Resources\BreweryResource;
use App\Models\Brewery;
use GuzzleHttp\ClientInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;


class BreweriesController extends Controller
{
    /**
     * @var ClientInterface
     */
    private $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function index(Paginated $request): array
    {
        Brewery::setClient($this->httpClient);
        $limit = $request->input('limit', config('app.pagination.limit'));
        $page = $request->input('page', 1);

        $paginator = new Paginator(
            BreweryResource::collection(Brewery::all($limit, $page)),
            $limit,
            $page
        );
        $paginator->hasMorePagesWhen(true);

        return $paginator->toArray();
    }

    public function show(Brewery $item): JsonResource
    {
        return new BreweryResource($item);
    }
}
