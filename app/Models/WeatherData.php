<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    use HasFactory;

    protected $fillable = [
      'city',
      'coordinates',
      'lat',
      'lon',
      'temperature',
      'feels_like',
      'humidity',
      'wind_speed'
    ];
}
