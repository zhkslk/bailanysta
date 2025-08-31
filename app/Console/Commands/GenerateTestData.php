<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateTestData extends Command
{
    protected $signature = 'test-data:generate';

    public function handle(): void
    {
        User::factory()->count(10)->create();

        foreach (User::all() as $user) {
            $user->posts()->create([
                'body' => fake()->paragraph(5),
            ]);
        }
    }
}
