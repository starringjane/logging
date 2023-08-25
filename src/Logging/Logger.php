<?php

namespace StarringJane\Logging\Logging;

use Monolog\Handler\LogglyHandler;
use Monolog\Level;
use Monolog\Logger as MonologLogger;
use StarringJane\Logging\Logging\Loggly\SJLogglyFormatter;

class Logger extends MonologLogger
{
    public function __construct($level = Level::Debug)
    {
        parent::__construct('starringjane');

        $this->pushHandler(new TeamsHandler($level));
        $this->pushLoggly($level);
    }

    private function pushLoggly($level)
    {
        $token = config('sj-logging.loggly.token');

        if (empty($token)) {
             return;
        }

        $handler = new LogglyHandler($token, $level);
        $handler->setTag(config('sj-logging.loggly.tag'));
        $handler->setFormatter(new SJLogglyFormatter());
        $this->pushHandler($handler);
    }
}
