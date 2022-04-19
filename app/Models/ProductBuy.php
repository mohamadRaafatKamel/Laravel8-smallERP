<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBuy extends Model
{
    use HasFactory;
    protected $table = 'product_buys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'product_id', 'category', 'exp_have', 'amount', 'status', 'unit_id', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        $query -> where('status','!=','99');
        return $query -> select(
            'id', 'product_id', 'category', 'exp_have', 'amount', 'status', 'unit_id', 'admin_id', 'created_at', 'updated_at'    
        );
    }

    public function scopeActive($query){
        $query -> where('status','!=','99');
        return $query -> where('status',0);
    }

    public function getActive(){
        return $this -> status == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public function getUnit(){
        return Unit::getName($this->unit_id) ;
    }

    public static function getProductCategoryUnit($pro_id, $cat){
        $units = [];
        $probuy = ProductBuy::select('unit_id')->where('product_id',$pro_id)->where('category',$cat)->first();
        if(isset($probuy->unit_id)){
            $units[] = [
                'id' =>$probuy->unit_id,
                'name' =>Unit::getName($probuy->unit_id),
            ];
            $unitId =$probuy->unit_id;
            while (true){
                $parant = Unit::getParantID($unitId);
                if($parant){
                    $units[] = [
                        'id' =>$parant,
                        'name' =>Unit::getName($parant),
                    ];
                    $unitId = $parant;
                }else{
                    break;
                }
            }
        }
        return $units;
    }

    public function getExpHave(){
        switch( $this ->exp_have){
            case 1 :
                return __('Yes');
            case 0 :
                return __('No');
        }
        return "_";
    }

}
