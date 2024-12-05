<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Herman',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Helena',
                'email' => 'parent1@example.com',
                'password' => bcrypt('password'),
                'role' => 'parent',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Salman',
                'email' => 'parent2@example.com',
                'password' => bcrypt('password'),
                'role' => 'parent',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Daniel',
                'email' => 'kafaadmin@example.com',
                'password' => bcrypt('password'),
                'role' => 'kafaadmin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Atikah Razali',
                'email' => 'teacher1@example.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ahmad Badruddin',
                'email' => 'teacher2@example.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Faizal Nordin',
                'email' => 'teacher3@example.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
