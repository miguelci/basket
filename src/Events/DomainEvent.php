<?php

namespace Basket\Events;

use Ramsey\Uuid\Uuid;

abstract class DomainEvent implements Event
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
