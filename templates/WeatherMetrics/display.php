
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="row">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Country</th>
                            <th scope="col">Temperature</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>

                    <tbody>
                            <?php
                                foreach($weatherMetrics as $key => $metric):
                            ?>
                            <tr>
                                <td><?= $metric->name ?></td>
                                <td><?= $metric->country ?></td>
                                <td><?= $metric->temp_f ?> °F</td>
                                <td><?= $metric->last_updated ?></td>
                            </tr>
                            <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <ul class="pagination">
                    <?= $this->Paginator->prev('<<') ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next('>>') ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- <h2>Current Weather in New York</h2>
<p>Temperature:  //$temperatureCelsius °C</p>
<p>Time:  //$temperatureTime </p>
<p>Condition:  //$conditionText ?></p>

<pre>
<? //print_r($data) ?>
</pre> -->
