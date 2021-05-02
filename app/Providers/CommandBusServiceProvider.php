<?php

namespace App\Providers;

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;

class CommandBusServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     */
    public function register(): void
    {

        $this->app->bind(CommandHandlerMiddleware::class, function () {
            return new CommandHandlerMiddleware(
                new ClassNameExtractor(),
                new ContainerLocator(
                    $this->app,
                    'Commands',
                    'Handlers'
                ),
                new HandleInflector()
            );
        });

        $this->app->bind(CommandBus::class, function () {
           $middleware =  new CommandHandlerMiddleware(
              new ClassNameExtractor(),
              new ContainerLocator(
                  $this->app,
                  'Commands',
                  'Handlers'
              ),
              new HandleInflector()
            );
            return new CommandBus([$middleware]);
        });

        $this->app->alias(CommandBus::class, 'bus');
    }

    public function provides(): array
    {
        return [
            CommandHandlerMiddleware::class,
            CommandBus::class,
            'bus',
        ];
    }
}