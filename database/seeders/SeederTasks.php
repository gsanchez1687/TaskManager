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
            ['title' => 'Wash the dishes', 'description' => 'Clean all plates, glasses, utensils, and cookware used in preparing or eating meals.', 'credit_for_task' => 1, 'expiration_date' => '2024-11-01', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Vacuum the floors', 'description' => 'Use a vacuum cleaner to remove dirt, dust, and crumbs from carpets or hard floors.', 'credit_for_task' => 2, 'expiration_date' => '2024-11-05', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Take out the trash', 'description' => 'Collect all household waste and put it in the outdoor trash bin for disposal.', 'credit_for_task' => 3, 'expiration_date' => '2024-11-15', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Dust the furniture', 'description' => 'Remove dust from surfaces like tables, shelves, and other furniture with a cloth or duster.', 'credit_for_task' => 3, 'expiration_date' => '2024-11-20', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Sweep the floor', 'description' => 'Use a broom to gather dirt and dust from the floor into a dustpan.', 'credit_for_task' => 3, 'expiration_date' => '2024-11-25', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Mop the floor', 'description' => 'Clean hard floors by using a mop and cleaning solution to remove stains and dirt.', 'credit_for_task' => 3, 'expiration_date' => '2024-11-30', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Make the bed', 'description' => 'Arrange the bed sheets, pillows, and blanket neatly to prepare the bed for use.', 'credit_for_task' => 3, 'expiration_date' => '2024-12-01', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Do the laundry', 'description' => 'Wash dirty clothes, sheets, and towels in the washing machine, and then dry them.', 'credit_for_task' => 3, 'expiration_date' => '2024-12-05', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Clean the windows', 'description' => 'Wipe windows with glass cleaner and a cloth or paper towel to make them clear and streak-free.', 'credit_for_task' => 3, 'expiration_date' => '2024-12-15', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Organize the closet', 'description' => 'Sort clothes, shoes, and other items in the closet to keep it neat and accessible.', 'credit_for_task' => 3, 'expiration_date' => '2024-12-20', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Wipe down the countertops', 'description' => 'Clean kitchen and bathroom counters with a cloth and cleaner to remove stains, crumbs, and bacteria.', 'credit_for_task' => 3, 'expiration_date' => '2024-12-25', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Water the plants', 'description' => 'Give the plants the necessary amount of water to keep them healthy.', 'credit_for_task' => 3, 'expiration_date' => '2024-12-30', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Clean the bathroom', 'description' => 'Scrub and sanitize the sink, toilet, bathtub, and mirrors in the bathroom.', 'credit_for_task' => 3, 'expiration_date' => '2025-01-01', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Fold the laundry', 'description' => 'Arrange clean, dry clothes neatly to make them ready for storage in drawers or closets.', 'credit_for_task' => 3, 'expiration_date' => '2025-01-05', 'hours_passed' => 0, 'statu_id' => 1],
            ['title' => 'Clean the fridge', 'description' => 'Discard expired items and wipe down shelves and drawers in the refrigerator to keep it sanitary.', 'credit_for_task' => 3, 'expiration_date' => '2025-01-15', 'hours_passed' => 0, 'statu_id' => 1],
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
