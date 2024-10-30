<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class SeederTasks extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            ['title' => 'Task 1', 'description' => 'Description 1', 'credit_for_task' => 1, 'expiration_date' => '2024-11-01', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 2', 'description' => 'Description 2', 'credit_for_task' => 2, 'expiration_date' => '2024-11-05', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 3', 'description' => 'Description 3', 'credit_for_task' => 3, 'expiration_date' => '2024-11-15', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 4', 'description' => 'Description 4', 'credit_for_task' => 3, 'expiration_date' => '2024-11-20', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 5', 'description' => 'Description 5', 'credit_for_task' => 3, 'expiration_date' => '2024-11-25', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 6', 'description' => 'Description 6', 'credit_for_task' => 3, 'expiration_date' => '2024-11-30', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 7', 'description' => 'Description 7', 'credit_for_task' => 3, 'expiration_date' => '2024-12-01', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 8', 'description' => 'Description 8', 'credit_for_task' => 3, 'expiration_date' => '2024-12-05', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 9', 'description' => 'Description 9', 'credit_for_task' => 3, 'expiration_date' => '2024-12-15', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 10', 'description' => 'Description 10', 'credit_for_task' => 3, 'expiration_date' => '2024-12-20', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 11', 'description' => 'Description 11', 'credit_for_task' => 3, 'expiration_date' => '2024-12-25', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 12', 'description' => 'Description 12', 'credit_for_task' => 3, 'expiration_date' => '2024-12-30', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 13', 'description' => 'Description 13', 'credit_for_task' => 3, 'expiration_date' => '2025-01-01', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 14', 'description' => 'Description 14', 'credit_for_task' => 3, 'expiration_date' => '2025-01-05', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Task 15', 'description' => 'Description 15', 'credit_for_task' => 3, 'expiration_date' => '2025-01-15', 'hours_passed' => 0, 'statu_id' => 1],
        ];

        foreach ($tasks as $key => $value) {
            Task::create([
                'title' => $value['title'],
                'description' => $value['description'],
                'credit_for_task' => $value['credit_for_task'],
                'expiration_date' => $value['expiration_date'],
                'hours_passed' => $value['hours_passed'],
                'statu_id' => $value['statu_id'],
            ]);
        }
    }
}
