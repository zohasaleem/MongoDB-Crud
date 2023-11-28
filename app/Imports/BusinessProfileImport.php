<?php

namespace App\Imports;

use App\Models\BusinessProfile;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BusinessProfileImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            // Assuming your BusinessProfile model has a create method.
            BusinessProfile::create($row->toArray());
        }
        // dd($row);

        // return new BusinessProfile([
        //     'name' => $row['name'],
        //     'phone' => $row['phone'],
        //     'category' => $row['category'],
        //     'address' => $row['address'],
        // ]);
    }
}
