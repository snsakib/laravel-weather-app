<?php

namespace App\Services;

use App\Models\WeatherData;
use GuzzleHttp\Client;

class WeatherService
{
    private $url;

    public function __construct(private Client $client)
    {
        $this->url = 'https://api.openweathermap.org/data/2.5/weather?';

    }

    public function makeURL()
    {
        $city_coordinates = [
            [
                'city' => 'Abu Dhabi, UAE',
                'lat' => 24.4667,
                'lon' => 54.3667,
            ],
            [
                'city' => 'Dubai, UAE',
                'lat' => 25.276987,
                'lon' => 55.296249,
            ],
            [
                'city' => 'Sharjah, UAE',
                'lat' => 25.3463,
                'lon' => 55.4209,
            ],
            [
                'city' => 'London, UK',
                'lat' => 51.5074,
                'lon' => -0.1278,
            ],
            [
                'city' => 'New York, USA',
                'lat' => 40.7128,
                'lon' => -74.0060,
            ],
            [
                'city' => 'Tokyo, Japan',
                'lat' => 35.682839,
                'lon' => 139.759455,
            ],
          ];

        $api_urls = [];

        foreach ($city_coordinates as $city_coordinate) {
            $url = $this->url . "lat={$city_coordinate['lat']}&lon={$city_coordinate['lon']}&units=metric&appid=" . env('OPEN_WEATHER_MAP_API_KEY');
            $data = [
              'city' => $city_coordinate['city'],
              'url' => $url
            ];
            array_push($api_urls, $data);
        }

        return $api_urls;
    }

    public function getData()
    {
        $api_urls = $this->makeURL();
        $weather_data = [];

        try {
            foreach ($api_urls as $api_url) {
                $res = $this->client->get($api_url['url']);
                $body = json_decode($res->getBody(), true);
                $data = [
                  'city' => $api_url['city'],
                  'data' => $body
                ];

                array_push($weather_data, $data);
            }
            return $weather_data;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function storeData($data) {

      foreach ($data as $item) {
        $weather_data = [
          'city' => $item['city'],
          'lat' => $item['data']['coord']['lat'],
          'lon' => $item['data']['coord']['lon'],
          'condition' => $item['data']['weather'][0]['main'],
          'temperature' => $item['data']['main']['temp'],
          'feels_like' => $item['data']['main']['feels_like'],
          'humidity' => $item['data']['main']['humidity'],
          'wind_speed' => $item['data']['wind']['speed']
        ];

        WeatherData::create($weather_data);
      }
    }
}
