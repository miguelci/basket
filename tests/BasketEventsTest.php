<?php

namespace Basket\Tests;

use Basket\EventBus\EventBus;
use Basket\EventBus\EventBusFactory;
use Basket\Events\AddProductToBasket;
use Basket\Events\RemoveProductFromBasket;
use Basket\Objects\Basket;
use Basket\Objects\Product;
use PHPUnit\Framework\TestCase;


/**
 * Class BasketTest
 * @package Basket\Tests
 * @covers  Basket
 */
class BasketEventTest extends TestCase
{

    const PRICE = '100';

    /**
     * @var Basket
     */
    private $basket;

    /**
     * @var EventBus
     */
    private $events;

    public function setUp()
    {
        parent::setUp();

        $this->basket = new Basket();
        $this->events = EventBusFactory::makeEventBus();
    }

    public function testCanBeInitialized()
    {
        $this->assertInstanceOf(Basket::class, new Basket());
    }

    public function testEventsCanBeInitialized()
    {
        $this->assertInstanceOf(EventBus::class, EventBusFactory::makeEventBus());
    }


    /**
     * Test if a product is added to a basket, it will only have one product
     */
    public function testAddToBasket()
    {
        $this->events->addEvent(new AddProductToBasket($this->basket, new Product('Mouse', self::PRICE)));
        $this->assertEquals(1, $this->basket->getTotalProducts());
    }

    /**
     * Test if a product is added and removed from a basket, it won't have any product
     */
    public function testAddRemoveFromBasket()
    {
        $product = new Product('Mouse', self::PRICE);
        $this->events->addEvent(new AddProductToBasket($this->basket, $product));
        $this->events->addEvent(new RemoveProductFromBasket($this->basket, $product));

        $this->assertEquals(0, $this->basket->getTotalProducts());
    }

    /**
     * Test if a product is added and removed from a basket, it won't have any product
     */
    public function testRemoveFromEmptyBasketDoesNotShowError()
    {
        $product = new Product('Mouse', self::PRICE);
        $this->events->addEvent(new RemoveProductFromBasket($this->basket, $product));

        $this->assertEquals(0, $this->basket->getTotalProducts());
    }

    /**
     * Test the price of a basket after a product is added
     */
    public function testBasketPriceOnAddedProduct()
    {
        $price = self::PRICE;

        $product = new Product('Mouse', $price);
        $this->events->addEvent(new AddProductToBasket($this->basket, $product));

        $this->assertEquals($price, $this->basket->getTotalPrice());
        $this->assertEquals(1, $this->basket->getTotalProducts());
    }

    /**
     * Test the price of a basket after a product is added and removed
     */
    public function testBasketPriceOnAddedRemovedProduct()
    {
        $product = new Product('Mouse', self::PRICE);
        $this->events->addEvent(new AddProductToBasket($this->basket, $product));
        $this->events->addEvent(new RemoveProductFromBasket($this->basket, $product));

        $this->assertEquals('0', $this->basket->getTotalPrice());
    }

    /**
     * Test the price of a basket after a product is removed from an empty basket
     */
    public function testBasketPriceOnRemovingProductFromEmptyBasket()
    {
        $product = new Product('Mouse', self::PRICE);
        $this->events->addEvent(new RemoveProductFromBasket($this->basket, $product));

        $this->assertEquals('0', $this->basket->getTotalPrice());
    }

}
