<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class SeederTypes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Father'],
            ['name' => 'Son'],
            ['name' => 'Dauther'],
            ['name' => 'Grandfather'],
            ['name' => 'grandmother'],
            ['name' => 'Brother'],
            ['name' => 'Sister'],
        ];

        foreach ($types as $key => $value) {
            Type::create([
                'name' => $value['name'],
            ]);
        }
    }
}
