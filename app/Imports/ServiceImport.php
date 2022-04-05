<?php

namespace App\Imports;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServiceImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    public $errors = [];
    public $errorRow = [];
    private $row = 3;

    /**
    * UsersImport constructor.
    * @param StoreEntity $store
    */
    public function __construct($errors = [])
    {
        $this->errors = $errors;
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
            '0' => [ // en
                'required',
                'unique:service,name_en',
                'string',
                'max:255',
            ],
            '1' => [ // ar
                'required',
                'string',
                'max:255',
            ],
            '2' => [ // category
                'required',
                'nullable',
                'exists:category,name_en',
            ],
            '3' => [
                'required',
                Rule::in(['in', 'out', 'lab']),
            ],
            '4' => [
                'required',
                Rule::in(['site', 'notsite']),
            ],
        ]);
    
        //   print_r($row);

        
        if ($validator->fails()) {
            $this->errorRow[] = $row;
            $this->errors[] = $validator->errors();
            // dd($validator->errors());
            return null;
        }
        if($row[3] == 'in')
            $type = 1;
        elseif($row[3] == 'out')
            $type = 2;
        elseif($row[3] == 'lab')
            $type = 3;
        else
            $type = null;

        try {
            return new Service([
                'name_en'     => $row[0],
                'name_ar'    => $row[1],
                'category_id'    => Category::getIDformNameEN($row[2]),
                'type' => $type ,
                'site' => ($row[4] == 'site')? 1 : 0 ,
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
