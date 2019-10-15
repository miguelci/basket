<?php
declare(strict_types=1);

namespace Basket\EventBus;

class EventBusFactory
{
    public static function makeEventBus(): EventBus
    {
        return new EventBus();
    }
}
