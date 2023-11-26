<?php

namespace App\Exports;

use App\Models\BusinessProfile;
use Maatwebsite\Excel\Concerns\FromCollection;

class BusinessProfilesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BusinessProfile::all();
    }
}
