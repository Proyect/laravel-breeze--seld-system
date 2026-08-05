<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'lastName' => 'Sistema',
            'email' => 'admin@infrasoft.com.ar',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Usuario',
            'lastName' => 'Demo',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        Product::create([
            'name' => 'Hosting Web Básico',
            'description' => 'Plan de hosting compartido con 10GB de almacenamiento',
            'price' => 4999.00,
            'stock' => 100,
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Desarrollo Web',
            'description' => 'Sitio web corporativo responsive',
            'price' => 150000.00,
            'stock' => 10,
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Soporte Técnico Mensual',
            'description' => 'Mantenimiento y soporte informático mensual',
            'price' => 25000.00,
            'stock' => 50,
            'status' => 'active',
        ]);
    }
}
