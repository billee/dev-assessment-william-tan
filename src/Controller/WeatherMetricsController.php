<?php
declare(strict_types=1);

namespace App\Controller;

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
    public function index()
    {
        $weatherMetrics = $this->paginate($this->WeatherMetrics);

        $this->set(compact('weatherMetrics'));
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
