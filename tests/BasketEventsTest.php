<?php
declare(strict_types=1);

namespace Basket\Tests;

use Basket\EventBus\EventBus;
use Basket\EventBus\EventBusFactory;
use Basket\Events\AddProductToBasket;
use Basket\Events\RemoveProductFromBasket;
use Basket\Objects\Basket;
use Basket\Objects\Product;
use PHPUnit\Framework\TestCase;

class BasketEventTest extends TestCase
{

    const PRICE = '100';

    /** @var Basket */
    private $basket;

    /** @var EventBus */
    private $events;

    public function setUp()
    {
        $this->basket = new Basket();
        $this->events = EventBusFactory::makeEventBus();
    }

    public function testCanBeInitialized(): void
    {
        $this->assertInstanceOf(Basket::class, new Basket());
    }

    public function testEventsCanBeInitialized(): void
    {
        $this->assertInstanceOf(EventBus::class, EventBusFactory::makeEventBus());
    }

    public function testAddToBasketResultsIntoOneProductInTheBasket(): void
    {
        $this->events->addEvent(new AddProductToBasket($this->basket, new Product('Mouse', self::PRICE)));
        $this->assertEquals(1, $this->basket->getTotalProducts());
    }

    public function testAddingAndRemovingFromBasket(): void
    {
        $product = new Product('Mouse', self::PRICE);
        $this->events->addEvent(new AddProductToBasket($this->basket, $product));
        $this->events->addEvent(new RemoveProductFromBasket($this->basket, $product));

        $this->assertEquals(0, $this->basket->getTotalProducts());
    }

    public function testRemoveFromEmptyBasketDoesNotShowError(): void
    {
        $product = new Product('Mouse', self::PRICE);
        $this->events->addEvent(new RemoveProductFromBasket($this->basket, $product));

        $this->assertEquals(0, $this->basket->getTotalProducts());
    }

    public function testBasketPriceOnAddedProduct(): void
    {
        $product = new Product('Mouse', self::PRICE);
        $this->events->addEvent(new AddProductToBasket($this->basket, $product));

        $this->assertEquals(self::PRICE, $this->basket->getTotalPrice());
        $this->assertEquals(1, $this->basket->getTotalProducts());
    }

    public function testBasketPriceOnAddedAndRemovedProduct(): void
    {
        $product = new Product('Mouse', self::PRICE);
        $this->events->addEvent(new AddProductToBasket($this->basket, $product));
        $this->events->addEvent(new RemoveProductFromBasket($this->basket, $product));

        $this->assertEquals('0', $this->basket->getTotalPrice());
    }

    public function testBasketPriceOnRemovingProductFromEmptyBasket(): void
    {
        $product = new Product('Mouse', self::PRICE);
        $this->events->addEvent(new RemoveProductFromBasket($this->basket, $product));

        $this->assertEquals('0', $this->basket->getTotalPrice());
    }
}
