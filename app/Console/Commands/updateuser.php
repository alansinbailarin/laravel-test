<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class updateuser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:updateuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user name, last name and timezone';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Take all users
        $users = User::all();

        // Iterate the users
        foreach ($users as $user) {
            // Assign an first name randomly
            $user->name = fake()->firstName();
            // Assign an last name randomly
            $user->lastname = fake()->lastName();
            // Assign a timezone between CET, CST and GMT+1 randomly
            $user->timezone = fake()->randomElement(['CET', 'CST', 'GMT+1']);

            $user->save();

            $this->info("User updated successful: {$user->name} {$user->lastname}, timezone: {$user->timezone}");
        }

        $this->info("All users updated randomly");
    }
}
