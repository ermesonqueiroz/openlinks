<?php

namespace App\Logging;

use Monolog\Logger;
use OpenTelemetry\API\Globals;
use OpenTelemetry\Contrib\Logs\Monolog\Handler as OTelHandler;

class OtelChannel
{
    public function __invoke(array $config): Logger
    {
        $logger = new Logger('otel');
        $loggerProvider = Globals::loggerProvider();

        $logger->pushHandler(
            new OTelHandler(
                $loggerProvider,
                \Monolog\Level::Info,
                true
            )
        );

        return $logger;
    }
}
