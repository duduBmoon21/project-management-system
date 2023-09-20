<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '12345678', 'role_id' => 1, 'remember_token' => '',],
            ['id' => 2, 'name' => 'Computer Science', 'email' => 'Head@office.com', 'password' => '12345678', 'role_id' => 2, 'remember_token' => '',],
            ['id' => 3, 'name' => 'Mr Daniel', 'email' => 'Unitleader@123.com', 'password' => '12345678', 'role_id' => 3, 'remember_token' => '',],
            ['id' => 4, 'name' => 'Abebe', 'email' => 'employee@123.com', 'password' => '12345678', 'role_id' => 4, 'remember_token' => '',],
            ['id' => 5, 'name' => 'ICT', 'email' => 'Head@office2.com', 'password' => '12345678', 'role_id' => 2, 'remember_token' => '',],
            ['id' => 6, 'name' => 'Software Engineering', 'email' => 'Head@office3.com', 'password' => '12345678', 'role_id' => 2, 'remember_token' => '',],
            ['id' => 7, 'name' => 'Electrical Engineering', 'email' => 'Head@office4.com', 'password' => '12345678', 'role_id' => 2, 'remember_token' => '',],
            ['id' => 8, 'name' => 'Mr Daniel', 'email' => 'Unitleader2@123.com', 'password' => '12345678', 'role_id' => 3, 'remember_token' => '',],
            ['id' => 9, 'name' => 'Aduye', 'email' => 'Unitleader3@123.com', 'password' => '12345678', 'role_id' => 3, 'remember_token' => '',],
            ['id' => 10, 'name' => 'Duduye 3', 'email' => 'Unitleader4@123.com', 'password' => '12345678', 'role_id' => 3, 'remember_token' => '',],
            ['id' => 11, 'name' => 'Abebe', 'email' => 'employee2@123', 'password' => '12345678', 'role_id' => 4, 'remember_token' => '',],
            ['id' => 12, 'name' => 'Abebech', 'email' => 'employee3@123', 'password' => '12345678', 'role_id' => 4, 'remember_token' => '',],
            ['id' => 13, 'name' => 'Eshetu', 'email' => 'employee4@123.com', 'password' => '12345678', 'role_id' => 4, 'remember_token' => '',],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
