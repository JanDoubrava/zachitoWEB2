<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Nejprve smažeme existující adminy
        DB::table('users')->where('role', 'admin')->delete();

        // Vytvoříme nového admina pomocí SQL
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.cz',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Admin byl vytvořen s těmito údaji:');
        $this->command->info('Email: admin@admin.cz');
        $this->command->info('Heslo: admin');
    }
} 