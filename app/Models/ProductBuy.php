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
        'id', 'product_id', 'category', 'exp_have', 'amount', 'status', 'unit_id', 
        'part_have', 'part_amount', 'part_unit_id', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        $query -> where('status','!=','99');
        return $query -> select(
            'id', 'product_id', 'category', 'exp_have', 'amount', 'status', 'unit_id', 
            'part_have', 'part_amount', 'part_unit_id', 'admin_id', 'created_at', 'updated_at'    
        );
    }

    public function scopeActive($query){
        $query -> where('status','!=','99');
        return $query -> where('status',0);
    }

    public function getActive(){
        return $this -> status == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public function getPackageUnit(){
        return Unit::getName($this->unit_id) ;
    }

    public function getPartUnit(){
        return Unit::getName($this->part_unit_id) ;
    }

    public function getPackageAmount(){
        return $this->amount." ".$this->getPackageUnit() ;
    }

    public function getPartAmount(){
        if($this->part_have == 0)
            return __('No');
        else
            return $this->part_amount." ".$this->getPartUnit() ;
    }

    public static function getProductCategoryUnit($pro_id, $cat){
        $probuy = ProductBuy::select('unit_id')->where('product_id',$pro_id)->where('category',$cat)->first();
        if(isset($probuy->unit_id)){
            $units[] = [
                'id' =>$probuy->unit_id,
                'name' =>Unit::getName($probuy->unit_id),
            ];
            return $units;
        }
        return false;
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

    public function getPartHave(){
        switch( $this ->part_have){
            case 1 :
                return __('Yes');
            case 0 :
                return __('No');
        }
        return "_";
    }

}
