<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaxType;

class TaxTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     //php artisan db:seed --class=TaxTypeSeeder
    public function run()
    {
        TaxType::create([
            'id' => '1',
            'name' => 'Value Added Tax (VAT)',
        ]);
        TaxType::create([
            'id' => '2',
            'name' => 'Goods & Service Tax (GST)',
        ]);
        TaxType::create([
            'id' => '3',
            'name' => 'No Tax',
        ]);
    }
}
