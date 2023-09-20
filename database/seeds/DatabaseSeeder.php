<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(DepartmentSeed::class);
        $this->call(EmployeeSeed::class);
   
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);

    }
}
