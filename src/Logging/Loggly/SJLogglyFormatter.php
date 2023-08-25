<?php

namespace StarringJane\Logging\Logging\Loggly;

use Monolog\Formatter\LogglyFormatter;
use Monolog\LogRecord;

class SJLogglyFormatter extends LogglyFormatter
{
    public function __construct(int $batchMode = self::BATCH_MODE_NEWLINES, bool $appendNewline = false)
    {
        parent::__construct($batchMode, $appendNewline);

        $this->includeStacktraces = true;
    }
}
