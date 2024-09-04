<?php

namespace Database\Seeders;

use App\Models\Bill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Bill::where('name', 'Energia')->first()) {
            Bill::create([
                'name' => 'Energia',
                'bill_value' => '207.98',
                'due_date' => '2024-09-03',
            ]);
        }

        if(!Bill::where('name', 'Faculdade')->first()) {
            Bill::create([
                'name' => 'Faculdade',
                'bill_value' => '407.98',
                'due_date' => '2024-09-07',
            ]);
        }
    }
}
