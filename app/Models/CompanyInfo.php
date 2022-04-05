<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $table = 'company_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'org_name', 'email', 'phone', 'price_list_id', 'website', 'contact_person_name', 'registration_num', 'tax_certificate_num', 'type', 'pay', 'description', 'admin_id', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'org_name', 'email', 'phone', 'price_list_id', 'website', 'contact_person_name', 'registration_num', 'tax_certificate_num', 'type', 'pay', 'description', 'admin_id', 'created_at', 'updated_at'
        );
    }

    static public function getType($type)
    {
        switch ($type){
            case 1:
                return "تامين";
                break;
            case 9:
                return "other";
                break;
        }
        return "";
    }

    static public function getPay($pay)
    {
        switch ($pay){
            case 1:
                return "later";
                break;
            case 2:
                return "cash";
                break;
        }
        return "";
    }

}
