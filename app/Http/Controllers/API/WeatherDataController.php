<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WeatherData;
use App\Services\WeatherService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeatherDataController extends Controller
{
    public function __construct(private WeatherService $weatherService)
    {
      
    }

    public function getData() {
      return response()->json(['data' => $this->weatherService->getData()]);
    }

    public function getTemperature(Request $request) {
      $city = $request->query('city');
      $date = Carbon::parse($request->query('date'));

      $data = WeatherData::selectRaw('temperature, TIME(created_at) AS time')
        ->where('city', $city)
        ->whereDate('created_at', $date->toDateString())
        ->get();

      return response()->json(['data' => $data]);
    }
}
