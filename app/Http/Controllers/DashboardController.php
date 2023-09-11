<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;
use Inertia\Inertia;

class DashboardController extends Controller
{
  public function __construct(private WeatherService $weatherService)
  {
  }

  public function index()
  {
    $data = $this->weatherService->getAndStoreData();
    
    return Inertia::render('Dashboard', [
      'data' => $data
    ]);
  }
}
