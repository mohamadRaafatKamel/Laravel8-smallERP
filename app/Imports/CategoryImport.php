<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Support\Facades\Validator;

class CategoryImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    public $errors = [];
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
                'unique:category,name_en',
                'string',
                'max:255',
            ],
            '1' => [ // ar
                'required',
                'string',
                'max:255',
            ],
            '2' => [
                'nullable',
                'exists:category,name_en',
            ],
        ],[
            'exists'=> "Parant :input not found",
            'unique'=> "Eng name :input added before"
        ]);
    
        //   print_r($row);

        
        if ($validator->fails()) {
            $this->errors[] = $validator->errors();
            // dd($validator->errors());
            return null;
        }

        try {
            return new Category([
                'name_en'     => $row[0],
                'name_ar'    => $row[1],
                'parent_id'    => Category::getIDformNameEN($row[2]),
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
