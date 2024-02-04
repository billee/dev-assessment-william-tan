<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Command\Command;
use Cake\Console\ConsoleIo;
use Cake\Http\Client;
use Cake\Console\ConsoleOptionParser;

class PullWeatherMetricsCommand extends Command
{
    // this command can be executed when
    //you run `bin/cake pull-weather-metrics London` in command line

    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser->addArgument('location', [
            'help' => 'The location to get the weather for',
            'required' => true,
        ]);

        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io)
    {
        $http = new Client();

        $url = 'http://api.weatherapi.com/v1/current.json';

        $apiKey = '4d54ef682dfb4f5f9d0205732240302';

        $params = [
            'key' => $apiKey,
            'q' => $args->getArgument('location'),
        ];

        $response = $http->get($url, $params);

        if ($response->isOk()) {
            $weatherData = $response->getJson();
            //$io->out(print_r($weatherData, true));

            $this->WeatherMetrics = $this->fetchTable('WeatherMetrics');

            $flatData = array_merge($weatherData['location'], $weatherData['current']);
            $io->out(print_r($flatData, true));
            $weatherEntity = $this->WeatherMetrics->newEntity($flatData);

            if($this->WeatherMetrics->save($weatherEntity)){
                $io->out('Weather data saved successfully');
            }else{
                $io->err('Failed to save weather data');
                print_r($weatherEntity->getErrors());
                exit;
            }
        } else {
            $io->err('Failed to retrieve weather data');
        }

        return self::CODE_SUCCESS;
    }
}

