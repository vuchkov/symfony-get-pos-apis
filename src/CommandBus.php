<?php

namespace App;

//use App\CommandHandler\BarHandler;
//use App\CommandHandler\FooHandler;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class CommandBus implements ServiceSubscriberInterface
{
    public function __construct(
        private ContainerInterface $locator,
    ) {
    }

    public static function getSubscribedServices(): array
    {
//        return array_merge(parent::getSubscribedServices(), [
        return [
//            'App\FooCommand' => FooHandler::class,
//            'App\BarCommand' => BarHandler::class,
        ];
    }

    public function handle(Command $command): mixed
    {
        $commandClass = get_class($command);

        if ($this->locator->has($commandClass)) {
            $handler = $this->locator->get($commandClass);

            return $handler->handle($command);
        }
    }
}