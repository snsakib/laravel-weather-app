<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherDataController extends Controller
{
    public function __construct(private WeatherService $weatherService)
    {
      
    }

    public function getData() {
      return $this->weatherService->getData();
    }
}
