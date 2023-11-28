<?php

namespace App\Exports;

use App\Models\BusinessProfile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class BusinessProfilesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */


    protected $data;

    public function __construct( $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            '_id',
            'name',
            'phone',
            'category',
            'address',
            'created_at',
            'updated_at'
        ];
    }
}
