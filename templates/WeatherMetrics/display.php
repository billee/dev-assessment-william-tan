<div class="container mx-auto">

    <div class="flex flex-wrap">
        <div class="w-full">
            <div class="flex flex-wrap">

                <table class="table-auto mx-auto font-bold border-collapse border-2 border-gray-500">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-gray-200 opacity-80 border-2 border-gray-500 p-2 text-center">Name</th>
                            <th scope="col" class="bg-gray-200 opacity-80 border-2 border-gray-500 p-2 text-center">Country</th>
                            <th scope="col" class="bg-gray-200 opacity-80 border-2 border-gray-500 p-2 text-center">Temperature</th>
                            <th scope="col" class="bg-gray-200 opacity-80 border-2 border-gray-500 p-2 text-center">Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            foreach($weatherMetrics as $key => $metric):
                                $bgColor = $key % 2 == 0 ? 'bg-gray-200' : 'bg-white';
                        ?>
                        <tr class="<?= $bgColor ?> opacity-80 border-2 border-gray-500">
                            <td class="p-2 text-center"><?= $metric['name'] ?></td>
                            <td class="p-2 text-center"><?= $metric['country'] ?></td>
                            <td class="p-2 text-center"><?= $metric['temp_average'] ?> °F</td>
                            <td class="p-2 text-center"><?= $metric['date_time']->i18nFormat('yyyy-MM-dd HH:mm') ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
