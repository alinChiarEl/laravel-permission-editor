<?php

namespace Laraveldaily\LaravelPermissionEditor\Commands;

use Illuminate\Console\Command;
use Laraveldaily\LaravelPermissionEditor\Models\Task;
use Illuminate\Support\Str;


class DeleteTaskById extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:task {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $t = Task::find($id);
        if(!empty($t)){
            if ($this->confirm('Are you sure?')) {
                
                $t->delete();
                $this->info('Task '.Str::upper($t->name).' has been succesfully deleted!');
                // return self::SUCCESS;
            }

        }else{
            $this->info('There is no task with this id');
        }
    }
}
