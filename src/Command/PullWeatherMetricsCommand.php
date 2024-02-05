<?php
namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use App\Service\Weather\WeatherApiService;

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
        $weatherApiService = new WeatherApiService();
        $cityWeather = $weatherApiService->getCityWeather($args->getArgument('location'));

        if ($cityWeather['response']->isOk()) {
            $weatherData = $cityWeather['content'];
            //$io->out(print_r($weatherData, true));

            $this->WeatherMetrics = $this->fetchTable('WeatherMetrics');

            $flatData = array_merge($weatherData['location'], $weatherData['current']);
            //$io->out(print_r($flatData, true));

            $weatherEntity = $this->WeatherMetrics->newEntity($flatData);

            if($this->WeatherMetrics->save($weatherEntity)){
                $io->out('Weather data saved successfully');
                return self::CODE_SUCCESS;
            }else{
                $io->err('Failed to save weather data');
                print_r($weatherEntity->getErrors());
                exit;
            }
        } else {
            $io->err('Failed to retrieve weather data');
        }
    }
}

