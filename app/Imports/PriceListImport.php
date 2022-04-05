<?php

namespace App\Imports;

use App\Models\PriceList;
use App\Models\PriceListInfo;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Support\Facades\Validator;

class PriceListImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    public $errors = [];
    private $row = 3;
    private $prListID ;

    /**
    * UsersImport constructor.
    * @param StoreEntity $store
    */
    public function __construct($prListID, $errors = [])
    {
        $this->errors = $errors;
        $this->prListID = $prListID;
    }

    public function startRow(): int
    {
        return 3;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (array_key_exists(++$this->row, $this->errors)) {
            return null;
        }
    
        $validator = Validator::make($row, [
            '0' => [ // service eng name
                'required',
                'exists:service,name_en',
                'string',
                'max:255',
            ],
            '1' => [ // service price
                'required',
                'max:255',
            ],
            
        ]);
    
        //   print_r($row);

        
        if ($validator->fails()) {
            // $this->errors[] = $validator->errors();
            $this->errors[] = $row[0];
            // dd($validator->errors());
            return null;
        }

        try {
            return new PriceListInfo([
                'service_id'     => Service::getIDformNameEN($row[0]),
                'price'    => $row[1],
                'price_list_id'    => $this->prListID,
                'admin_id' =>  Auth::user()->id
            ]);
        } catch (\Exception $e) {
            return null;
        }


    
        //   DB::beginTransaction();
        //   try {
        //       User::create([
        //           'name' => $row[0],
        //           'email' => $row[1],
        //           'password' => $row[2],
        //       ]);
    
        //       DB::commit();
        //   } catch (Exceptions $e) {
        //       DB::rollBack();
        //       Log::debug($e);
        //   }
    }
}
