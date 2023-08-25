<?php

namespace StarringJane\Logging\Logging;

use Monolog\Level;
use Monolog\LogRecord;
use Illuminate\Support\Facades\Notification;
use Monolog\Handler\AbstractProcessingHandler;
use NotificationChannels\MicrosoftTeams\MicrosoftTeamsChannel;
use StarringJane\Logging\Notifications\TeamsErrorNotification;

class TeamsHandler extends AbstractProcessingHandler
{
    public function __construct($level = Level::Debug)
    {
        parent::__construct($level);
    }

    protected function write(LogRecord $record): void
    {
        $route = config('sj-logging.teams.webhook_url');
        if (empty($route)) {
            return;
        }

        Notification::route(MicrosoftTeamsChannel::class, $route)
            ->notify(new TeamsErrorNotification($record->context['exception'], $route))
        ;
    }
}
