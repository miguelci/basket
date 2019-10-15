<?php
declare(strict_types=1);

namespace Basket\Events;

use Ramsey\Uuid\Uuid;

abstract class DomainEvent implements Event
{
    /** @var string */
    public $id;

    /** @var string */
    public $name;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}
