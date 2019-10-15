<?php

use Basket\EventBus\EventBusFactory;
use Basket\Events\AddProductToBasket;
use Basket\Events\CreateBasket;
use Basket\Events\RemoveProductFromBasket;
use Basket\Objects\Basket;
use Basket\Objects\Product;

require_once __DIR__ . '/vendor/autoload.php';

$eventBus = EventBusFactory::makeEventBus();

$basket     = new Basket();
$mouse      = new Product('Mouse', 20);
$monitor    = new Product('Monitor', 40);
$computer   = new Product('Computer PC', 450);
$mac        = new Product('MacBook', 950);
$watch      = new Product('Watch', 250);
$headphones = new Product('Headphones', 150);


$eventBus->addEvent(new CreateBasket($basket));
$eventBus->addEvent(new AddProductToBasket($basket, $mouse));
$eventBus->addEvent(new AddProductToBasket($basket, $monitor));
$eventBus->addEvent(new RemoveProductFromBasket($basket, $mouse));
$eventBus->addEvent(new AddProductToBasket($basket, $computer));
$eventBus->addEvent(new AddProductToBasket($basket, $mac));
$eventBus->addEvent(new AddProductToBasket($basket, $watch));
$eventBus->addEvent(new RemoveProductFromBasket($basket, $computer));
$eventBus->addEvent(new AddProductToBasket($basket, $headphones));

//print_r($eventBus->serialize());

//print_r($basket->getProducts());

print_r($basket->getTotalPrice() . PHP_EOL);
