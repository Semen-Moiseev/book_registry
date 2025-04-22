<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void {
        // Создание начального администратора
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.ru',
            'password' => Hash::make('root'),
            'role' => 'admin'
        ]);

        // Создаем тестового пользователя (автора)
        User::create([
            'name' => 'Пользователь',
            'email' => 'user@user.ru',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        Author::create(['name' => 'Пользователь']);
    }
}
