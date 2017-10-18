<?php

namespace Basket\Events;

use Ramsey\Uuid\Uuid;

/**
 * FutureFuel
 *
 * Event.php
 * Created on 10/10/17
 *
 * Miguel Heitor - miguel@futurefuel.io
 */
class Event
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