<?php

// namespace App\Console\Commands;
namespace Laraveldaily\LaravelPermissionEditor\Commands;

use Illuminate\Console\Command;
use Laraveldaily\LaravelPermissionEditor\Models\Task;



class CreateTask extends Command
{
    protected $signature = 'make:task';
 
    protected $description = 'Make a new task';
 
    public function handle()
    {
        // ... code to create the new task
        $t = Task::create(
            ['name' => fake()->word()]
        );
        $this->info('The command was successful! Task '.$t->name.' was created!');
        return Command::SUCCESS;
    }
}