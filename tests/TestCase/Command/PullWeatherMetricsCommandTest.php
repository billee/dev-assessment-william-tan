<?php

use Cake\Http\Response;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use PHPUnit\Framework\TestCase;
use App\Command\PullWeatherMetricsCommand;
use App\Service\Weather\WeatherApiService;

class PullWeatherMetricsCommandTest extends TestCase
{
    public function testExecute()
    {
        $args = $this->createMock(Arguments::class);
        $io = $this->createMock(ConsoleIo::class);
        $args->expects($this->once())
            ->method('getArgument')
            ->with('location')
            ->willReturn('London');

        $weatherApiService = $this->createMock(WeatherApiService::class);
        $weatherApiService->expects($this->once())
            ->method('getCityWeather')
            ->with('London')
            ->willReturn([
                'response' => new Response(['statusCode' => 200]),
                'content' => ['location' => [], 'current' => []],
            ]);


            $command = new PullWeatherMetricsCommand();
            $command->weatherApiService = $weatherApiService;



            $result = $command->execute($args, $io);  //??????????????????????? error here.....


            $this->assertEquals(Command::CODE_SUCCESS, $result);
    }
}


//error in testing
//1) PullWeatherMetricsCommandTest::testExecute
//Cake\Database\Exception\DatabaseException: Cannot describe weather_metrics. It has 0 columns.
