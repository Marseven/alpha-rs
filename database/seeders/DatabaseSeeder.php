<?php

namespace Database\Seeders;

use App\Models\SecurityObject;
use App\Models\SecurityPermission;
use App\Models\SecurityRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        SecurityObject::create([
            'name' => 'admin',
            'url' => 'http://localhost:8888/alpha/public/admin/',
            'icon' => 'admin',
            'enable' => 1,
        ]);

        SecurityRole::create([
            'name' => 'SuperAdmin',
            'security_object_id' => 1,
        ]);

        SecurityPermission::create([
            'name' => 'Users',
            'description' => "Users",
            'user_id' => 1,
        ]);

        SecurityPermission::create([
            'name' => 'Hospitals',
            'description' => "Hospitals",
            'user_id' => 1,
        ]);

        SecurityPermission::create([
            'name' => 'Folders',
            'description' => "Folders",
            'user_id' => 1,
        ]);

        SecurityPermission::create([
            'name' => 'Quotes',
            'description' => "Quotes",
            'user_id' => 1,
        ]);

        SecurityPermission::create([
            'name' => 'Payments',
            'description' => "Payments",
            'user_id' => 1,
        ]);

        SecurityPermission::create([
            'name' => 'Serices',
            'description' => "Serices",
            'user_id' => 1,
        ]);

        User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@alpha.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'security_role_id' => 1,
        ]);

        \App\Models\User::factory(2)->create();
    }
}
