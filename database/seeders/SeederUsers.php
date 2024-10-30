<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SeederUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = [
            ['name' => 'Admin', 'email' => '9eGgj@example.com', 'password' => bcrypt('12345678')],
            ['name' => 'Admin', 'email' => 'jVJ2E@example.com', 'password' => bcrypt('12345678')],
        ];

        $users = [
            ['name' => 'Guillermo', 'email' => 'jVJ2H@example.com', 'password' => bcrypt('12345678')],
            ['name' => 'Estiben', 'email' => 'w7sQw@example.com', 'password' => bcrypt('12345678')],
            ['name' => 'Luis', 'email' => 'jVJ2Y@example.com', 'password' => bcrypt('12345678')],
            ['name' => 'Daniel', 'email' => 'jVJ2G@example.com', 'password' => bcrypt('12345678')],
            ['name' => 'Cristian', 'email' => 'jVJ2D@example.com', 'password' => bcrypt('12345678')],
            ['name' => 'Daniel', 'email' => 'jVJ2C@example.com', 'password' => bcrypt('12345678')],
            ['name' => 'Cristian', 'email' => 'jVJ2B@example.com', 'password' => bcrypt('12345678')],
        ];

        $aliadoRole = Role::where('name', 'Usuario')->first();
        foreach ($users as $key => $value) {
            $user = User::create($value);
            $user->assignRole($aliadoRole);
        }

        $aliadoRole = Role::where('name', 'Admin')->first();
        foreach ($admin as $key => $value) {
            $user = User::create($value);
            $user->assignRole($aliadoRole);
        }

    }
}
