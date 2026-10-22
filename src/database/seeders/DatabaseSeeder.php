<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->isProduction()) {
            $this->seedProductionAdmin();

            return;
        }

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

    /**
     * En producción no se crean usuarios ni productos demo: solo un admin con
     * credenciales tomadas de ADMIN_EMAIL / ADMIN_PASSWORD.
     */
    private function seedProductionAdmin(): void
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (! $email || ! $password || strlen($password) < 12) {
            throw new RuntimeException('En producción definí ADMIN_EMAIL y ADMIN_PASSWORD (mínimo 12 caracteres) antes de ejecutar db:seed.');
        }

        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Admin'),
                'password' => Hash::make($password),
                'role' => 'admin',
            ],
        );
    }
}
