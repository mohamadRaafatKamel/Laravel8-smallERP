<?php

namespace App\Http\Resources;

use App\Models\City;
use App\Models\DoctorInfo;
use App\Models\Governorate;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $doctor =[];
        $arrayReturn =[
            'id' => $this->user()->id,
            'fname' => $this->user()->fname,
            'lname' => $this->user()->lname,
            'username' => $this->user()->username,
            'birth_date' => $this->user()->birth_date,
            'email' => $this->user()->email,
            'phone' => $this->user()->phone,
            'mobile' => $this->user()->mobile,
            'type' => ($this->user()->type != null)? User::getUserType($this->user()->type) : "",
            'verification' => $this->user()->verification,
            'gender' => ($this->user()->gender != null)? User::getGenderType($this->user()->gender) : "",
            'title' => $this->user()->title,
            'nationality_code' => $this->user()->nationality_code,
            'governorate_id' => ($this->user()->governorate_id != null)?Governorate::getNameEN($this->user()->governorate_id): "",
            'city_id' => ($this->user()->city_id != null)? City::getNameEN($this->user()->city_id) : "",
            'address' => $this->user()->address,
            'adress2' => $this->user()->adress2,
            // 'account_owner_name' => $this->user()->account_owner_name,
            // 'account_num' => $this->user()->account_num,
            // 'bank_name' => $this->user()->bank_name,
            // 'identity_id' => $this->user()->identity_id,
            // 'passport_id' => $this->user()->passport_id,
        ];
        // Doctor
        if ($this->user()->type == '2'){
            $doctor = DoctorInfo::select()->where('user_id', $this->user()->id)->first();
            if (isset($doctor->id)) {
                $doctor = [
                    'doctor_id'=> $doctor->id,
                    'specialty'=> ($doctor->specialty != null )?Specialty::getNameEN($doctor->specialty) :"",
                    'cv'=> $doctor->cv,
                    'phone1'=> $doctor->phone1,
                    'phone2'=> $doctor->phone2,
                    'photo'=> $doctor->photo,
                    'description'=> $doctor->description,
                ];
            }
        }

        return array_merge($arrayReturn, $doctor);
    }
}
