<?php

namespace App\Imports;

use App\Models\PreRegisteredCompany;
use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CompanyImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows, SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    use SkipsFailures;

    public function model(array $row)
    {
        return new PreRegisteredCompany([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'alt_email_1'    => $row['alt_email_1'],
            'alt_email_2'    => $row['alt_email_2'],
            'temp_categories' => $row['category'],
            'country_id'    => $this->getCountry($row['country']),
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => [
                'email',
                'unique:companies,email'
            ],
        ];
    }

    public function getCountry($name){
            $country = Country::where('name',$name)->firstOrFail();
            return $country->id ?? '0';
    }
    
    public function chunkSize(): int
    {
        return 200;
    }
}
