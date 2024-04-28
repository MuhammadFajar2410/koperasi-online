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
            ['name' => 'Saldo Awal', 'created_by' => 'system'],
            ['name' => 'Saldo Akhir', 'created_by' => 'system'],
            ['name' => 'Dana Pendidikan & Sosial', 'created_by' => 'system'],
            ['name' => 'Dana Cadangan', 'created_by' => 'system'],
            ['name' => 'Dana Administrasi', 'created_by' => 'system'],
            ['name' => 'Dana Transport Pelatihan', 'created_by' => 'system'],
            ['name' => 'Sisa RAT', 'created_by' => 'system'],
            ['name' => 'Pengembalian Angsuran', 'created_by' => 'system'],
            ['name' => 'Adjustment', 'created_by' => 'system'],
        ];

        foreach ($categories as $category) {
            TransactionCategory::create($category);
        }
    }

}
