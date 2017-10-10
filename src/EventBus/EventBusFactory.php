<?php

namespace Basket\EventBus;

/**
 * FutureFuel
 *
 * EventBusFactory.php
 * Created on 10/10/17
 *
 * Miguel Heitor - miguel@futurefuel.io
 */
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