<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunAppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the application in CLI mode';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
