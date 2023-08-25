#Starring Jane logging tool for Laravel
## Available channels
- Teams
- Loggly

## Installation
Run the composer install command to install the package
```bash
composer require starringjane/laravel-logging
```
## Configuration
Optionally you can publish the config file with:
```bash
php artisan vendor:publish --provider="StarringJane\Logging\LoggingServiceProvider" --tag="config"
```
Set up the following environment variables in your .env file:
```bash
TEAMS_WEBHOOK_URL=
LOGGLY_TOKEN=
LOGGLY_TAG=
```
When one or multiple of these variables are not set, the corresponding logging channel will not be used.

Finaly all you need to do is add the following line to your config/logging.php file and enable the channel in stack channels or as a single channel:  
```php
'channels' => [
    ...
    'starringjane' => [
        'driver' => 'custom',
        'via' => \StarringJane\Logging\Logging\LoggerChannel::class,
        'level' => 'notice',
    ],
    ...
],
```
