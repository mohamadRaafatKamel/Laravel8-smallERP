<?php

namespace App\Imports;

use App\Models\Referral;
use Maatwebsite\Excel\Concerns\ToModel;

class ReferralImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Referral([
            //
        ]);
    }
}
