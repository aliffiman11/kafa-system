<?php

namespace Database\Seeders;

use App\Models\Parents;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parents = Parents::get();

        foreach ($parents as $parent) {
            Student::create([
                'name' => fake()->name(),
                'parents_id' => $parent->id,
                'class' => fake()->name(),
            ]);
        }

        
    }
}
