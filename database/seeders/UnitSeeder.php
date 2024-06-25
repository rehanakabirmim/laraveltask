<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('units')->insert([
            [
                'name' => 'Kilogram',
                'code' => 'kg',
                'for' => 'weight',
                'base_unit' => 'g',
                'operator' => 'multiply',
                'operation_value' => '1000',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gram',
                'code' => 'g',
                'for' => 'weight',
                'base_unit' => 'g',
                'operator' => 'multiply',
                'operation_value' => '1',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Meter',
                'code' => 'm',
                'for' => 'length',
                'base_unit' => 'cm',
                'operator' => 'multiply',
                'operation_value' => '100',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Centimeter',
                'code' => 'cm',
                'for' => 'length',
                'base_unit' => 'cm',
                'operator' => 'multiply',
                'operation_value' => '1',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Liter',
                'code' => 'L',
                'for' => 'volume',
                'base_unit' => 'ml',
                'operator' => 'multiply',
                'operation_value' => '1000',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Milliliter',
                'code' => 'ml',
                'for' => 'volume',
                'base_unit' => 'ml',
                'operator' => 'multiply',
                'operation_value' => '1',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
