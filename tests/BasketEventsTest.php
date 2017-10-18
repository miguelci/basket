<?php

namespace Basket\Tests;

use Basket\EventBus\EventBusFactory;
use Basket\Events\AddProductToBasket;
use Basket\Events\RemoveProductFromBasket;
use Basket\Objects\Basket;
use Basket\Objects\Product;
use PHPUnit\Framework\TestCase;

/**
 * FutureFuel
 *
 * BasketTest.php
 * Created on 17/10/17
 *
 * Miguel Heitor - miguel@futurefuel.io
 */

/**
 * Class BasketTest
 * @package Basket\Tests
 * @covers  Basket
 */
class BasketEventTest extends TestCase
{

    public function testCanBeInitialized()
    {
        $this->assertInstanceOf(Basket::class, new Basket());
    }

    /**
     * Test if a product is added to a basket, it will only have one product
     */
    public function testAddToBasket()
    {
        $basket = new Basket();
        $events = EventBusFactory::makeEventBus();
        $events->addEvent(new AddProductToBasket($basket, new Product('Mouse', '100')));

        $this->assertEquals(1, count($basket->getProducts()));
    }

    /**
     * Test if a product is added and removed from a basket, it won't have any product
     */
    public function testAddRemoveFromBasket()
    {
        $basket  = new Basket();
        $events  = EventBusFactory::makeEventBus();
        $product = new Product('Mouse', '100');
        $events->addEvent(new AddProductToBasket($basket, $product));
        $events->addEvent(new RemoveProductFromBasket($basket, $product));

        $this->assertEquals(0, count($basket->getProducts()));
    }

    /**
     * Test if a product is added and removed from a basket, it won't have any product
     */
    public function testRemoveFromEmptyBasketDoesntShowError()
    {
        $basket  = new Basket();
        $events  = EventBusFactory::makeEventBus();
        $product = new Product('Mouse', '100');
        $events->addEvent(new RemoveProductFromBasket($basket, $product));

        $this->assertEquals(0, count($basket->getProducts()));
    }

    /**
     * Test the price of a basket after a product is added
     */
    public function testBasketPriceOnAddedProduct()
    {
        $price = '100';

        $basket  = new Basket();
        $events  = EventBusFactory::makeEventBus();
        $product = new Product('Mouse', $price);
        $events->addEvent(new AddProductToBasket($basket, $product));

        $this->assertEquals($price, $basket->getTotalPrice());
    }

    /**
     * Test the price of a basket after a product is added and removed
     */
    public function testBasketPriceOnAddedRemovedProduct()
    {
        $basket  = new Basket();
        $events  = EventBusFactory::makeEventBus();
        $product = new Product('Mouse', '100');
        $events->addEvent(new AddProductToBasket($basket, $product));
        $events->addEvent(new RemoveProductFromBasket($basket, $product));

        $this->assertEquals('0', $basket->getTotalPrice());
    }

    /**
     * Test the price of a basket after a product is added and removed
     */
    public function testBasketPriceOnRemovingProductFromEmptyBasket()
    {
        $basket  = new Basket();
        $events  = EventBusFactory::makeEventBus();
        $product = new Product('Mouse', '100');
        $events->addEvent(new RemoveProductFromBasket($basket, $product));

        $this->assertEquals('0', $basket->getTotalPrice());
    }

}