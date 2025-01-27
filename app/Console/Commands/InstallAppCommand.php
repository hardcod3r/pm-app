<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\select;
class InstallAppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'App Installer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Migrate the database with :fresh option
        $this->call('migrate:fresh');
        // call the command to fetch countries
        $this->call('app:fetch-countries');
        //call db:seed command to seed the database
        $this->call('db:seed');

        $this->info(' ✅  Installation completed! 🚀');
        
        $run_tests = select(
            label: 'Would you like to run tests?',
            options: ['Yes', 'No'],
        );

        if($run_tests === 'Yes'){
            $this->call('test');
        }

    }
}
