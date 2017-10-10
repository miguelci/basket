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


class Product
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $price;

    /**
     * Product constructor.
     *
     * @param string $name  The name of the product.
     * @param int    $price The price of the product.
     */
    public function __construct($name, $price)
    {
        $this->name  = $name;
        $this->price = $price;
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
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

}