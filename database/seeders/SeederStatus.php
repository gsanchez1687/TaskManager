<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class SeederStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
           ['name' => 'Active','style'=>'text-primary'],
           ['name' => 'Inactive','style'=>'text-danger'],
           ['name' => 'Pending','style'=>'text-warning'],
           ['name' => 'Suspended','style'=>'text-info'],
           ['name' => 'Completed','style'=>'text-success'],
           ['name' => 'Expired','style'=>'text-dark'],
        ];

        foreach ($status as $key => $value) {
            Status::create([
                'name' => $value['name'],
                'style' => $value['style'],
            ]);
        }
    }
}