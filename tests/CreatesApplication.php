<?php

namespace Tests;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    public function createApplication()
    {
        $app = new Application(
            realpath(__DIR__ . '/../')
        );

        $app->singleton(
            Kernel::class,
            new class($app, $app->make(Dispatcher::class)) extends \Illuminate\Foundation\Console\Kernel
            {

            }
        );

        $app->singleton(
            ExceptionHandler::class,
            new class($app) extends \Illuminate\Foundation\Exceptions\Handler
            {

            }
        );

        $app->instance('config', $config = new Repository([]));

        return $app;
    }
}
