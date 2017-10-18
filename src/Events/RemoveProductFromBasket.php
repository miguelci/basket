<?php
/**
 * FutureFuel
 *
 * RemoveProductFromBasket.php
 * Created on 10/10/17
 *
 * Miguel Heitor - miguel@futurefuel.io
 */

namespace Basket\Events;


use Basket\Objects\Basket;
use Basket\Objects\Product;

class RemoveProductFromBasket extends DomainEven
{

    /**
     * @var Basket
     */
    private $basket;

    /**
     * @var Product
     */
    private $product;

    /**
     * RemoveProductFromBasket constructor.
     *
     * @param Basket  $basket
     * @param Product $product
     */
    public function __construct($basket, $product)
    {
        parent::__construct();
        $this->name = 'RemovedProductFromBasket';
        $this->basket  = $basket;
        $this->product = $product;
    }

    /**
     * Will execute the needed function for each event.
     */
    public function apply()
    {
        $this->basket->removeProductFromBasket($this->product);
    }

    /**
     * Returns the object in a readable way
     *
     * @return string
     */
    public function serialize()
    {
        return json_encode([
            'id'            => $this->id,
            'name'          => $this->name,
            'basket_id'     => $this->basket->getBasketId(),
            'product_name'  => $this->product->getName(),
            'product_price' => $this->product->getPrice(),
            'date' => date('Y-m-d H:i:s')
        ]);
    }
}