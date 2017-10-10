<?php
/**
 * FutureFuel
 *
 * Basket.php
 * Created on 10/10/17
 *
 * Miguel Heitor - miguel@futurefuel.io
 */

namespace Basket\Objects;


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
     * @var int
     */
    private $totalPrice;

    /**
     * Basket constructor.
     */
    public function __construct()
    {
        $this->basketId   = md5(sha1("noinafaDAWDadanwdiawdoanwdoianw2626#$#/nseo$#"));
        $this->products   = [];
        $this->totalPrice = 0;
    }


    /**
     * @return string
     */
    public function getBasketId()
    {
        return $this->basketId;
    }

    /**
     * @param string $basketId
     */
    public function setBasketId($basketId)
    {
        $this->basketId = $basketId;
    }

    /**
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @return int
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param int $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @param Product $product
     */
    public function addProductToBasket($product)
    {
        $this->products[] = $product;
        $this->totalPrice += $product->getPrice();
    }

    /**
     * @param Product $product
     */
    public function removeProductFromBasket($product)
    {
        $aux = $this->getProductIndex($product->getName());

        if ($aux !== null) {
            array_splice($this->products, $aux, 1);
            $this->totalPrice -= $product->getPrice();
        }
    }

    /**
     * Update the total price of the basket if needed.
     */
    public function updateBasketPrice()
    {
        if (!empty($this->products)) {
            foreach ($this->products as $product) {
                $this->totalPrice += $product->getPrice();
            }
        }
    }

    /**
     * @param string $productName
     *
     * @return int | null
     */
    private function getProductIndex($productName)
    {
        foreach ($this->products as $key => $product) {
            if ($product->getName() === $productName) {
                return $key;
            }
        }
        return null;
    }


}