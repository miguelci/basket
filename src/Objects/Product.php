<?php
/**
 * FutureFuel
 *
 * Item.php
 * Created on 10/10/17
 *
 * Miguel Heitor - miguel@futurefuel.io
 */

namespace Basket\Objects;


use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

class Product
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Money
     */
    private $price;

    /**
     * Product constructor.
     *
     * @param string $name  The name of the product.
     * @param string $price The price of the product.
     */
    public function __construct($name, $price)
    {
        $this->id    = Uuid::uuid4()->toString();
        $this->name  = $name;
        $this->price = new Money($price, new Currency('EUR'));
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Money
     */
    public function getPrice()
    {
        return $this->price;
    }

}