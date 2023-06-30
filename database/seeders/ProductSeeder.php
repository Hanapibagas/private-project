<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product_code' => 'DM',
            'photo' => 'datadumy.jpg',
            'name' => 'Barang 1',
            'deskripsi' => 'Data dumy',
            'purchase_price' => '75000',
            'selling_price' => '80000',
            'stock' => '200',
            'category_id' => '1'
        ]);
        Product::create([
            'product_code' => 'DM',
            'photo' => 'datadumy.jpg',
            'name' => 'Barang 2',
            'deskripsi' => 'Data dumy',
            'purchase_price' => '75000',
            'selling_price' => '90000',
            'stock' => '200',
            'category_id' => '1'
        ]);
        Product::create([
            'product_code' => 'DM',
            'photo' => 'datadumy.jpg',
            'name' => 'Barang 3',
            'deskripsi' => 'Data dumy',
            'selling_price' => '100000',
            'purchase_price' => '75000',
            'stock' => '200',
            'category_id' => '1'
        ]);
    }
}
