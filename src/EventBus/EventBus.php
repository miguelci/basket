<?php

namespace Basket\EventBus;

use Basket\Events\Event;

/**
 * FutureFuel
 *
 * EventBus.php
 * Created on 10/10/17
 *
 * Miguel Heitor - miguel@futurefuel.io
 */
class EventBus
{

    /**
     * @var Event[]
     */
    private $events;

    /**
     * EventBus constructor.
     */
    public function __construct()
    {
        $this->events = [];
    }

    /**
     * @param Event $event
     */
    public function addEvent(Event $event)
    {
        $event->apply();

        $this->events[] = [
            'id'      => $event->id,
            'payload' => $event->serialize()
        ];
    }

    /**
     * Returns with the current events on the event bus
     *
     * @return string
     */
    public function serialize()
    {
        return print_r($this->events, true);
    }

}