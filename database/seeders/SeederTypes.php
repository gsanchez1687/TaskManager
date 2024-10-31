<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

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
