<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $city = $request->query('city', 'Nairobi');
        $apiKey = config('services.openweather.key');
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($url);

        if ($response->successful()){
            return response()->json($response->json());
        }else{
            return response()->json([
                'error' => 'Could not fetch weather data',
                'details' => $response->json(),
            ], $response->status());
        }
    }
}
