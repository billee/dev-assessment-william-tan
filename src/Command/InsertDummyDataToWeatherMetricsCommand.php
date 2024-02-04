<?php
namespace App\Command;

use Cake\Http\Client;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\ORM\TableRegistry;

class InsertDummyDataToWeatherMetricsCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $weatherMetricsTable = TableRegistry::getTableLocator()->get('WeatherMetrics');

        for ($i = 0; $i < 1000; $i++) {
            $data[] = [
                'name' => 'New York',
                'country' => 'USA',
                'temp_f' => rand(90, 100),
                'last_updated' => strtotime('2024-02-04 02:06:00') + $i * 180,
            ];
        }

        $entities = $weatherMetricsTable->newEntities($data);
        $result = $weatherMetricsTable->saveMany($entities);

        if ($result) {
            echo "Records inserted successfully.";
        } else {
            echo "Failed to insert records.";
        }
    }
}

