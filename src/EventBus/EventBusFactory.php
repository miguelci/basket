<?php

namespace Basket\EventBus;

class EventBusFactory
{
    /**
     * @return EventBus
     */
    public static function makeEventBus()
    {
        return new EventBus();
    }

}
