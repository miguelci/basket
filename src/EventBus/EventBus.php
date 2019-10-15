<?php
declare(strict_types=1);

namespace Basket\EventBus;

use Basket\Events\DomainEvent;

class EventBus
{
    /** @var DomainEvent[] */
    private $events;

    public function __construct()
    {
        $this->events = [];
    }

    public function addEvent(DomainEvent $event): void
    {
        $event->apply();

        $this->events[] = [
            'id'      => $event->id,
            'payload' => $event->serialize()
        ];
    }

    public function serialize(): string
    {
        return print_r($this->events, true);
    }

}
