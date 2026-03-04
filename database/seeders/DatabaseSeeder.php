<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
{
   // Create Admin
    User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('admin123'),
        'is_admin' => 1,
    ]);

    // Create Normal User
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
        'is_admin' => 0,
    ]);

    Product::create([
        'name' => "Women's Silk Embroidered Blouse",
        'price' => 49.99,
        'image' => 'images/sample2.jpg',
        'description' => 'Elegant silk blouse with delicate embroidery — perfect for festive occasions.'
    ]);

    Product::create([
        'name' => 'Chudidar Cotton Set - Red',
        'price' => 39.50,
        'image' => 'images/sample3.jpg',
        'description' => 'Soft cotton chudidar set with matching dupatta.'
    ]);

    Product::create([
        'name' => 'Chudidar Anarkali Set - Navy',
        'price' => 59.00,
        'image' => 'images/sample4.jpg',
        'description' => 'Stylish Anarkali-style chudidar made from breathable fabric.'
    ]);

    Product::create([
        'name' => "Women's Lace Trim Blouse",
        'price' => 34.00,
        'image' => 'images/sample5.jpg',
        'description' => 'Delicate lace trim blouse, pairs well with jeans or skirts.'
    ]);

    Product::create([
        'name' => "Women's Summer Floral Kurti",
        'price' => 27.50,
        'image' => 'images/sample6.jpg',
        'description' => 'Breathable cotton kurti with floral prints, ideal for casual wear.'
    ]);

    Product::create([
        'name' => "Women's Partywear Chudidar - Gold",
        'price' => 79.99,
        'image' => 'images/sample7.jpg',
        'description' => 'Luxurious partywear chudidar with gold accents.'
    ]);

    Product::create([
        'name' => "Women's Rayon Long Kurti",
        'price' => 32.00,
        'image' => 'images/sample8.jpg',
        'description' => 'Comfortable rayon kurti with side slits and elegant neckline.'
    ]);

    Product::create([
        'name' => "Women's Chudidar Set - Green",
        'price' => 44.25,
        'image' => 'images/sample9.jpg',
        'description' => 'Cotton chudidar set in vibrant green with printed dupatta.'
    ]);

    Product::create([
        'name' => "Women's Embroidered Kurti",
        'price' => 45.00,
        'image' => 'images/sample10.jpg',
        'description' => 'Hand-embroidered kurti with elegant motifs for semi-formal occasions.'
    ]);
}
}
