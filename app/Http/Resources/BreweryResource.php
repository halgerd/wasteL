<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BreweryResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brewery_type' => $this->brewery_type,
            'address' => [
                'street' => $this->street,
                'address_2' => $this->address_2,
                'address_3' => $this->address_3,
                'county_province' => $this->county_province,
                'state' => $this->state,
                'postal_code' => $this->postal_code,
                'country' => $this->country,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
                'phone' => $this->phone,
            ],
            'website_url' => $this->website_url,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'link' => url("api/breweries", ['breweryId' => $this->id]),
        ];
    }
}
