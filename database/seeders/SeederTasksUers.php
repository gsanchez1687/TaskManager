<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskUser;
class SeederTasksUers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = User::all();
        $task = Task::all();

        for ($i = 1; $i <= 10; $i++) {
            TaskUser::create([
                'user_id' => $user->random()->id,
                'task_id' => $task->random()->id,
            ]);
        }

    }
}
