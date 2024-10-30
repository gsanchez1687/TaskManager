<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Database\Seeder;

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
