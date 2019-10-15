<?php
declare(strict_types=1);

namespace Basket\Objects;

use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

class Product
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var Money */
    private $price;

    public function __construct(string $name, string $price)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->name = $name;
        $this->price = new Money($price, new Currency('EUR'));
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

}
