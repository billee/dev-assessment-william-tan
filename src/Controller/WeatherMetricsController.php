<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client;


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
    public function display(string $temp_f)
    {
        $apiKey = '4d54ef682dfb4f5f9d0205732240302';
        // echo (env('WEATHER_API_KEY'));
        //$apiKey = getenv('WEATHER_API_KEY');
        //print_r($_ENV);

        $cityName = 'New York';

        $url = "https://api.weatherapi.com/v1/current.json?key=$apiKey&q=$cityName";
        $client = new Client();
        $response = $client->get($url);

        $jsonResponse = $response->getBody()->getContents();
        $weatherData = json_decode($jsonResponse, true);


        $temperatureCelsius = $weatherData['current']['temp_c'];
        $conditionText = $weatherData['current']['condition']['text'];

        $this->set('temperatureCelsius', $temperatureCelsius);
        $this->set('conditionText', $conditionText);

    }

    /**
     * View method
     *
     * @param string|null $id Weather Metric id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $weatherMetric = $this->WeatherMetrics->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('weatherMetric'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $weatherMetric = $this->WeatherMetrics->newEmptyEntity();
        if ($this->request->is('post')) {
            $weatherMetric = $this->WeatherMetrics->patchEntity($weatherMetric, $this->request->getData());
            if ($this->WeatherMetrics->save($weatherMetric)) {
                $this->Flash->success(__('The weather metric has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The weather metric could not be saved. Please, try again.'));
        }
        $this->set(compact('weatherMetric'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Weather Metric id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $weatherMetric = $this->WeatherMetrics->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $weatherMetric = $this->WeatherMetrics->patchEntity($weatherMetric, $this->request->getData());
            if ($this->WeatherMetrics->save($weatherMetric)) {
                $this->Flash->success(__('The weather metric has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The weather metric could not be saved. Please, try again.'));
        }
        $this->set(compact('weatherMetric'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Weather Metric id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $weatherMetric = $this->WeatherMetrics->get($id);
        if ($this->WeatherMetrics->delete($weatherMetric)) {
            $this->Flash->success(__('The weather metric has been deleted.'));
        } else {
            $this->Flash->error(__('The weather metric could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
