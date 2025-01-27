<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use App\Models\Country;
class FetchCountriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch countries from the API and store them in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching countries from REST API');
        $response = Http::connectTimeout(20)->withoutVerifying()->get('https://restcountries.com/v3.1/all?fields=name,cca2');
        if ($response->successful()) {
            $collection = collect($response->json());
            $bar = $this->output->createProgressBar(count($collection));
            $bar->start();
            foreach($collection as $country) {
                $flattened = Arr::dot($country);
                $slice = Arr::only($flattened, ['name.common', 'cca2']);
                Country::firstOrCreate(
                    [ 'name' => $slice['name.common'] ],
                    [ 'cca2' => $slice['cca2']]
                );
                $bar->advance();

            }
            $bar->finish();
            $this->info(' ✅  Fetching countries completed');
        } else {
            $this->error('Failed to fetch countries');
        }
    }
}
