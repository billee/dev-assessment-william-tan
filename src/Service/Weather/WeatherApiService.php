<?php
namespace App\Service\Weather;

use Cake\Http\Client;

class WeatherApiService{

    /**
     * Get weather data for a given city
     * @param $cityName
     * @return array (response object and content)
     */
    public function getCityWeather($cityName){

        $apiKey = '4d54ef682dfb4f5f9d0205732240302';
        //$apiKey = getenv('WEATHER_API_KEY');  // this should be in .env but it is not working for me yet.

        $url = "https://api.weatherapi.com/v1/current.json?key=$apiKey&q=$cityName";
        $client = new Client();
        $response = $client->get($url);

        $jsonResponse = $response->getBody()->getContents();

        return ['response' => $response, 'content' => json_decode($jsonResponse, true)];
    }

}
