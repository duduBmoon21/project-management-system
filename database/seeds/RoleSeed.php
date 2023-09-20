<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'title' => 'Admin',],
            ['id' => 2, 'title' => 'Head Office',],
            ['id' => 3, 'title' => 'Team Leader',],
            ['id' => 4, 'title' => 'Team Member',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
