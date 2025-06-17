<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('systems')->insert([
            ['name' => 'Sistem HR', 'description' => 'Sistem pengelolaan karyawan'],
            ['name' => 'Sistem Keuangan', 'description' => 'Sistem pencatatan transaksi perusahaan'],
        ]);
    }
}
