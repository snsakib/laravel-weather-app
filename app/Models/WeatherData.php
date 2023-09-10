<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    use HasFactory;

    protected $table = 'weather_data';

    protected $fillable = [
      'city',
      'lat',
      'lon',
      'condition',
      'temperature',
      'feels_like',
      'humidity',
      'wind_speed'
    ];
}
