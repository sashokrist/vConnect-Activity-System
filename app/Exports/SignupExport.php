<?php

namespace App\Exports;

use App\Signup;
use App\SignupTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class SignupExport implements FromCollection
{
    public function headings(): array {
        return [
            "signupTitle","name"
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SignupTitle::getSignup();
    }
}
