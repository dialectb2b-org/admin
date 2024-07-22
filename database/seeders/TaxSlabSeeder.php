<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaxSlab;

class TaxSlabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     //php artisan db:seed --class=TaxTypeSeeder
    public function run()
    {
        TaxSlab::create([
            'id' => '1',
            'tax_type_id' => '2',
            'slab' => '0',
        ]);

        TaxSlab::create([
            'id' => '2',
            'tax_type_id' => '2',
            'slab' => '5',
        ]);

        TaxSlab::create([
            'id' => '3',
            'tax_type_id' => '2',
            'slab' => '12',
        ]);

        TaxSlab::create([
            'id' => '4',
            'tax_type_id' => '2',
            'slab' => '18',
        ]);

        TaxSlab::create([
            'id' => '5',
            'tax_type_id' => '2',
            'slab' => '28',
        ]);
    }
}
