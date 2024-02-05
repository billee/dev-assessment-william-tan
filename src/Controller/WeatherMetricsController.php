<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;


/**
 * WeatherMetrics Controller
 *
 * @method \App\Model\Entity\WeatherMetric[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WeatherMetricsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function display()
    {
        $params = $this->request->getParam('pass');
        $endParamName = end($params);

        $this->weatherMetrics = TableRegistry::getTableLocator()->get('WeatherMetrics');

        $retrievedMetrics = $this->weatherMetrics
                    ->find('all')
                    ->where(['name' => 'New York', 'country' => 'USA'])  // this is being assumed (hard_coded)
                    //->limit(200)
                    ->toArray();

        $groups = array_chunk($retrievedMetrics, 20);

        $weatherMetrics = [];
        foreach ($groups as $group) {
            $totalTemp = 0;
            foreach ($group as $record) {
                $totalTemp += $record[$endParamName];
            }

            $weatherMetrics[] = [
                'name'=> $record['name'],
                'country' => $record['country'],
                'date_time' => FrozenTime::createFromTimestamp($record['last_updated']),
                'temp_average' => $totalTemp / count($group)
            ];
        }

        //$this->set('weatherMetrics', $this->paginate($weatherMetrics, ['limit' => 10]));
        $this->set(compact('weatherMetrics'));

    }
}
