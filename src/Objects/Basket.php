<?php

namespace Basket\Objects;


use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

class Basket
{
    /**
     * @var string
     */
    private $basketId;

    /**
     * @var Product[]
     */
    private $products;

    /**
     * @var Money
     */
    private $totalPrice;

    /**
     * Basket constructor.
     */
    public function __construct()
    {
        $this->basketId   = Uuid::uuid4()->toString();
        $this->products   = [];
        $this->totalPrice = new Money(0, new Currency('EUR'));
    }


    /**
     * @return string
     */
    public function getBasketId()
    {
        return $this->basketId;
    }


    /**
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return string
     */
    public function getTotalPrice()
    {
        return $this->totalPrice->getAmount();
    }

    /**
     * @param Product $product
     */
    public function addProductToBasket($product)
    {
        $this->products[$product->getId()] = $product;
        $this->totalPrice                  = $this->totalPrice->add($product->getPrice());
    }

    /**
     * @param Product $product
     */
    public function removeProductFromBasket($product)
    {
        if ($product !== null && isset($this->products[$product->getId()])) {
            unset($this->products[$product->getId()]);
            $this->totalPrice = $this->totalPrice->subtract($product->getPrice());
        }
    }

}
