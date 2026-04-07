<?php

namespace StarringJane\Logging\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use NotificationChannels\MicrosoftTeams\ContentBlocks\TextBlock;
use NotificationChannels\MicrosoftTeams\MicrosoftTeamsAdaptiveCard;
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
        return MicrosoftTeamsAdaptiveCard::create()
            ->to($this->route)
            ->title($this->exception->getMessage())
            ->content([
                TextBlock::create()
                    ->setText(Str::Markdown('```' . PHP_EOL . $this->exception->getTraceAsString()))
                    ->setWeight('Bolder')
                    ->setSize('Large'),
            ]);
    }
}
