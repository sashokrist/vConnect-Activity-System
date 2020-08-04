<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array {
        return [
            "name","username","email"
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {

        return collect(User::getUsers());
        // return Page::getUsers(); // Use this if you return data from Model without using toArray().
    }
}
