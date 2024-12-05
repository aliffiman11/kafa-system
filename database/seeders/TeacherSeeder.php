<?php

namespace Database\Seeders;

use App\Models\teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::get();

        foreach ($users as $user) {
            if ($user->role == 'teacher') {
                teacher::create([
                    'user_id' => $user->id,
                    'name' => $user->name
                ]);
            }
        }
    }
}
