<?php

namespace App\Exports;

use App\Poll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PollExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array {
        return [ "question", "answer", "username" ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {

        return collect(Poll::getPolls());
        // return Page::getUsers(); // Use this if you return data from Model without using toArray().
    }
}
