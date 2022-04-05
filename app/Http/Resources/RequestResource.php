<?php

namespace App\Http\Resources;

use App\Models\City;
use App\Models\Governorate;
use App\Models\Requests;
use App\Models\Service;
use App\Models\Specialty;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
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
            "id" => (string)$this->id,
            "phone" => $this->phone,
            "specialty_id" => Specialty::getNameEN($this->specialty_id),
            "service_id" => Service::getNameEN($this->service_id),
            "type" => Requests::getRequestType($this->type),
            "governorate_id" => Governorate::getNameEN($this->governorate_id) ,
            "city_id" => City::getNameEN($this->city_id),
            "adress" => $this->adress,
            "adress2" => $this->adress2,
            "land_mark" => $this->land_mark,
            "floor" => $this->floor,
            "apartment" => $this->apartment,
            // "visit_time_day" => $this->visit_time_day,
            // "visit_time_from" => $this->visit_time_from,
            // "visit_time_to" => $this->visit_time_to,
            "state callcenter" => Requests::getRequestState($this->status_cc),
            "state operation" => Requests::getRequestState($this->status_in_out),
            "created_at" => $this->created_at,
        ];
    }
}
