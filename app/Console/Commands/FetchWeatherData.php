<?php

namespace App\Console\Commands;

use App\Services\WeatherService;
use Illuminate\Console\Command;

class FetchWeatherData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:weatherData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and insert the weather data in every 10 minutes';

    public function __construct(private WeatherService $weatherService)
    {
      parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->weatherService->getData();
    }
}
