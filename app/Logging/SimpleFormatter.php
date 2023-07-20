<?php

namespace App\Logging;
use Monolog\Formatter\LineFormatter;
class SimpleFormatter
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                date("Y-m-d h:i:s")." "."%message% ". PHP_EOL
            ));
        }
    }
}
