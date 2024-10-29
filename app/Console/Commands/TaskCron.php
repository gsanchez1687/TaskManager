<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class TaskCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CronJob Task by hour';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //sql para encontrar todas las tareas por el status pendiente
        $tasks = Task::where('statu_id', 3)->get();
        foreach ($tasks as $task) {
            $task->hours_passed = $task->hours_passed + 1;
            $task->save();
        }
    }
}
