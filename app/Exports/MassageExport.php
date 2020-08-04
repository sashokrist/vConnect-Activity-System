<?php

namespace App\Exports;

use App\Massage;
use Maatwebsite\Excel\Concerns\FromCollection;

class MassageExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array {
        return [ "json" ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {

        return collect(Massage::getMassage());
        // return Page::getUsers(); // Use this if you return data from Model without using toArray().
    }
}
