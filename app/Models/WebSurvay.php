<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class WebSurvay extends Model
{
    use HasFactory;

    protected $table = 'web_survey';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'name', 'phone', 'age', 'opinion_carehub', 'know_carehub', 'try_carehub', 'note', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'user_id', 'name', 'phone', 'age', 'opinion_carehub', 'know_carehub', 'try_carehub', 'note', 'created_at', 'updated_at'
        );
    }

    static public function getAge($id)
    {
        switch ($id){
            case 1:
                return "من 20 - 30 سنة";
                break;
            case 2:
                return "من 30 - 40 سنة";
                break;
            case 3:
                return "من 40 - 50 سنة";
                break;
            case 4:
                return "اكبر من 50 سنة";
                break;
        }
       return "";
    }

    static public function getOpinion($id)
    {
        switch ($id){
            case 1:
                return "واقعية";
                break;
            case 2:
                return "غير واقعية";
                break;
            case 3:
                return "ممكن اجربها";
                break;
            case 4:
                return "لم اجربها";
                break;
        }
       return "";
    }

    static public function getYesorNo($id)
    {
        switch ($id){
            case 1:
                return "نعم";
                break;
            case 2:
                return "لا";
                break;
        }
       return "";
    }

}
