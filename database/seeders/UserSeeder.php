<?php

namespace Database\Seeders;

use App\Enums\userRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->addAdmin();
    }

    public function addAdmin(): void
    {
        $admin = User::where('role', userRole::Admin)->get();

        if ($admin->count() > 0) {
            return;
        }

        User::create([
            'name' => 'admin',
            'email' => 'admin@quickquiz.krystianmyslek.com',
            'password' => bcrypt('Admin123'),
            'role' => userRole::Admin
        ]);

        return;
    }
}
