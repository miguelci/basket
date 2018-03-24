<?php

namespace Basket\EventBus;

use Basket\Events\DomainEvent;
use Basket\Events\Event;


class EventBus
{

    /**
     * @var DomainEvent[]
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
     * @param DomainEvent $event
     */
    public function addEvent(DomainEvent $event)
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
