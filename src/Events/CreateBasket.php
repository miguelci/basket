<?php
declare(strict_types=1);

namespace Basket\Events;

use Basket\Objects\Basket;

class CreateBasket extends DomainEvent
{
    /** @var Basket */
    private $basket;

    public function __construct(Basket $basket)
    {
        parent::__construct();
        $this->name   = __CLASS__;
        $this->basket = $basket;
    }

    public function apply(): void
    {
        // With storage, this would pass the info of the new basket to it.
    }

    public function serialize(): string
    {
        return json_encode([
            'id' => $this->id,
            'basket' => $this->basket->getBasketId(),
            'name' => $this->name,
            'date' => date('Y-m-d H:i:s')
        ]);
    }
}
