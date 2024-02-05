==============================================================
@William MINGW64 /c/xampp/htdocs/sites/dev-assessment-william-tan (master)
$ php --version
PHP 8.2.9 (cli) (built: Aug 1 2023 12:35:15) (ZTS Visual C++ 2019 x64)
Copyright (c) The PHP Group
Zend Engine v4.2.9, Copyright (c) Zend Technologies
===============================================================
Env: VSCode, Xampp, Tailwind, sqlite3,
===============================================================
SQLite table structure
CREATE TABLE weather_metrics(id INTEGER PRIMARY KEY, name TEXT, country TEXT, temp_f REAL, last_updated INTEGER)
I just created the table that is needed in the application.
I create a command script PullWeatherMetricsCommand.php to populate the table with 1000 records.
I did not use migration here since I am not familiar yet with CakePHP syntax. I usually do migration in Laravel.

# run command: bin/cake InsertDummyDataToWeatherMetrics

===============================================================
PHPUnit TEST
I created PullWeatherMetricsCommandTest.php and WeatherMetricsControllerTest.php.
Both had fatal errors when run that says "Cake\Database\Exception\DatabaseException: Cannot describe weather_metrics. It has 0 columns." I can not figure this out. Something about configuration in the app.php?

run ./vendor/bin/phpunit tests/TestCase/Command/PullWeatherMetricsCommandTest.php
run ./vendor/bin/phpunit tests/TestCase/Controller/WeatherMetricsControllerTest.php
===============================================================
The pagination is not working yet. I tried to fix it but no luck yet. It will work when the output to the view is in object form. But when it was converted to array form due to chunking it for the average temperature, it will not work.
===============================================================
$apiKey = getenv('WEATHER_API_KEY');
this did not work. Maybe I am missing configuration on this. I did consult the internet.
===============================================================
for the 20 times accessing the api to get the average temperature in an hour, this should be done in cron job where a script will access the api every 3 minutes. But actually the api does its update every 15 minutes, so I did not create any cron script.
what I did was to create a command script PullWeatherMetricsCommand.php to populate the table one time only with 1000 records of 3 mins(in unix time) apart for the last_updated column. So 20 of these will make an hour of data to be averaged.
===============================================================
I separated script(src/Service/Weather/WeatherApiService.php) to access api as a service
I did not do phpUnit for this.
===============================================================
http://localhost:8765/weather-metrics/display/temp_f is working but not the pagination. Can not figure out yet.
run command: bin/cake InsertDummyDataToWeatherMetricsCommand is working
===============================================================

SQLite table structure
CREATE TABLE weather_metrics(id INTEGER PRIMARY KEY, name TEXT, country TEXT, temp_f REAL, last_updated INTEGER)
run command: bin/cake PullWeatherMetricsCommand to populate the table
