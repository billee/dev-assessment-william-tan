<?php

use Cake\TestSuite\TestCase;
use App\Controller\WeatherMetricsController;

class WeatherMetricsControllerTest extends TestCase
{
    public function testDisplay()
    {
        $controller = new WeatherMetricsController();

        $this->assertNull($controller->display());
    }
}


// this is the error in testing
//1) WeatherMetricsControllerTest::testDisplay
//Cake\Database\Exception\DatabaseException: Cannot describe weather_metrics. It has 0 columns.
