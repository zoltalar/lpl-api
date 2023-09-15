<?php

namespace Database\Seeders;

use Arr;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->admins() as $admin) {
            Admin::firstOrCreate(
                Arr::only($admin, ['username', 'email']),
                Arr::except($admin, ['username', 'email']),
            );
        }
    }
    
    private function admins(): array
    {
        return [
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'username' => 'admin',
                'email' => 'john@example.com',
                'password' => 'welcome',
                'active' => 1
            ]
        ];
    }
}
