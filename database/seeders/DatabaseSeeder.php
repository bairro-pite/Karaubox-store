<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kategori
        Category::create(['name' => 'roupa Boxing', 'slug' => 'roupa-boxing']);
        Category::create(['name' => 'equipamento Boxing', 'slug' => 'sasan-boxing']);

        // Produk Contoh
        Product::create([
            'name' => 'kalsa boxing profesional',
            'description' => 'Bahan adem & nyaman, cocok latihan & pertandingan',
            'price' => 35.00,
            'category_id' => 1,
            'stock' => 20
        ]);

        Product::create([
            'name' => 'luvas boxing',
            'description' => 'Kulit asli, ukuran 10oz¨C16oz, pelindung tangan maksimal',
            'price' => 65.00,
            'category_id' => 2,
            'stock' => 15
        ]);

        Product::create([
            'name' => 'roupa Jersey boxing',
            'description' => 'Bahan cepat kering, nyaman dipakai seharian',
            'price' => 25.00,
            'category_id' => 1,
            'stock' => 30
        ]);

        Product::create([
            'name' => 'Pelindung Gigi Boxing',
            'description' => 'Silikon lembut, melindungi gigi & rahang',
            'price' => 12.00,
            'category_id' => 2,
            'stock' => 50
        ]);
    }
}
