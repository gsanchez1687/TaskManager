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
            ['name' => 'Admin', 'email' => '9eGgj@example.com', 'password' => bcrypt('12345678'),'type_id'=> 1],
            ['name' => 'Admin', 'email' => 'jVJ2E@example.com', 'password' => bcrypt('12345678'),'type_id'=> 1],
        ];

        $users = [
            ['name' => 'Liam', 'email' => 'jVJ2H@example.com', 'password' => bcrypt('12345678'),'type_id'=>2],
            ['name' => 'Emma', 'email' => 'w7sQw@example.com', 'password' => bcrypt('12345678'),'type_id'=>2],
            ['name' => 'Noah', 'email' => 'jVJ2Y@example.com', 'password' => bcrypt('12345678'),'type_id'=>2],
            ['name' => 'Olivia', 'email' => 'jVJ2G@example.com', 'password' => bcrypt('12345678'),'type_id'=>2],
            ['name' => 'William', 'email' => 'jVJ2D@example.com', 'password' => bcrypt('12345678'),'type_id'=>2],
            ['name' => 'Ava', 'email' => 'jVJ2C@example.com', 'password' => bcrypt('12345678'),'type_id'=>2],
            ['name' => 'Benjamin', 'email' => 'jVJ2B@example.com', 'password' => bcrypt('12345678'),'type_id'=>2],
        ];

        $aliadoRole = Role::where('name', 'son user')->first();
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
