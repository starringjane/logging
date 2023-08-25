<?php

namespace StarringJane\Logging\Logging;

class LoggerChannel
{
    /**
     * @param array $config
     *
     * @return Logger
     */
    public function __invoke(array $config)
    {
        return new Logger($config['level']);
    }
}
