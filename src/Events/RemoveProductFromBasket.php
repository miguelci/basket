<?php
declare(strict_types=1);

namespace Basket\Events;

use Basket\Objects\Basket;
use Basket\Objects\Product;

class RemoveProductFromBasket extends DomainEvent
{
    /** @var Basket */
    private $basket;

    /** @var Product */
    private $product;

    public function __construct(Basket $basket, Product $product)
    {
        parent::__construct();
        $this->name = __CLASS__;
        $this->basket = $basket;
        $this->product = $product;
    }

    public function apply(): void
    {
        $this->basket->removeProductFromBasket($this->product);
    }

    public function serialize(): string
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'basket_id' => $this->basket->getBasketId(),
            'product_name' => $this->product->getName(),
            'product_price' => $this->product->getPrice(),
            'date' => date('Y-m-d H:i:s')
        ]);
    }
}
