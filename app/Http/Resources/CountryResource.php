<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "country_code" => $this->country_code ,
            "country_enName" => $this->country_enName,
            "country_arName" => $this->country_arName,
            "country_enNationality" => $this->country_enNationality,
            "country_arNationality" => $this->country_arNationality,
        ];
    }
}
