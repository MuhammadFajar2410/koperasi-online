<?php

namespace Database\Seeders;

use App\Models\TransactionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Saldo Awal', 'created_by' => '2'],
            ['name' => 'Saldo Akhir', 'created_by' => '2'],
            ['name' => 'Dana Pendidikan & Sosial', 'created_by' => '2'],
            ['name' => 'Dana Cadangan', 'created_by' => '2'],
            ['name' => 'Dana Administrasi', 'created_by' => '2'],
            ['name' => 'Dana Transport Pelatihan', 'created_by' => '2'],
            ['name' => 'Sisa RAT', 'created_by' => '2'],
            ['name' => 'Pengembalian Angsuran', 'created_by' => '2'],
            ['name' => 'Adjustment', 'created_by' => '2'],
        ];

        foreach ($categories as $category) {
            TransactionCategory::create($category);
        }
    }

}
