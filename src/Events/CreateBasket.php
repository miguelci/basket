<?php


namespace Basket\Events;


use Basket\Objects\Basket;

class CreateBasket extends DomainEvent
{

    /**
     * @var Basket
     */
    private $basket;

    public function __construct($basket)
    {
        parent::__construct();
        $this->name   = __CLASS__;
        $this->basket = $basket;
    }

    /**
     * Will execute the needed function for each event.
     */
    public function apply()
    {
        // TODO: Implement apply() method.
    }

    /**
     * Returns the object in a readable way
     *
     * @return string
     */
    public function serialize()
    {
        return json_encode([
            'id' => $this->id,
            'basket' => $this->basket->getBasketId(),
            'name' => $this->name,
            'date' => date('Y-m-d H:i:s')
        ]);
    }
}
