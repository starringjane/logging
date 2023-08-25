<?php

namespace StarringJane\Logging\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use NotificationChannels\MicrosoftTeams\MicrosoftTeamsChannel;
use NotificationChannels\MicrosoftTeams\MicrosoftTeamsMessage;

class TeamsErrorNotification extends Notification
{
    use Queueable;

    public $exception;
    public string $route;

    public function __construct(\Throwable $exception, string $route = null)
    {
        $this->exception = $exception;
        $this->route = $route;
    }

    public function via()
    {
        return [MicrosoftTeamsChannel::class];
    }

    public function toMicrosoftTeams()
    {
        return MicrosoftTeamsMessage::create()
                ->to($this->route)
                ->type('error')
                ->title($this->exception->getMessage())
                ->content(Str::Markdown('```' . PHP_EOL . $this->exception->getTraceAsString()) )
        ;
    }
}
