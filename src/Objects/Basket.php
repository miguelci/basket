<?php
declare(strict_types=1);

namespace Basket\Objects;

use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

class Basket
{
    /** @var string */
    private $basketId;

    /** @var Product[] */
    private $products;

    /** @var Money */
    private $totalPrice;

    public function __construct()
    {
        $this->basketId = Uuid::uuid4()->toString();
        $this->products = [];
        $this->totalPrice = new Money(0, new Currency('EUR'));
    }

    public function getBasketId(): string
    {
        return $this->basketId;
    }

    /** @return Product[] */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function getTotalProducts(): int
    {
        return count($this->products);
    }

    public function getTotalPrice(): string
    {
        return $this->totalPrice->getAmount();
    }

    public function addProductToBasket(Product $product): void
    {
        $this->products[$product->getId()] = $product;
        $this->totalPrice = $this->totalPrice->add($product->getPrice());
    }

    public function removeProductFromBasket(Product $product): void
    {
        if ($product !== null && isset($this->products[$product->getId()])) {
            unset($this->products[$product->getId()]);
            $this->totalPrice = $this->totalPrice->subtract($product->getPrice());
        }
    }

}
