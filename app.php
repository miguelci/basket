<?php
/**
 * FutureFuel
 *
 * app.php
 * Created on 10/10/17
 *
 * Miguel Heitor - miguel@futurefuel.io
 */

require_once __DIR__ . '/vendor/autoload.php';

$eventBus = \Basket\EventBus\EventBusFactory::makeEventBus();

$basket     = new \Basket\Objects\Basket();
$mouse      = new \Basket\Objects\Product('Mouse', 20);
$monitor    = new \Basket\Objects\Product('Monitor', 40);
$computer   = new \Basket\Objects\Product('Computer PC', 450);
$mac        = new \Basket\Objects\Product('MacBook', 950);
$watch      = new \Basket\Objects\Product('Watch', 250);
$headphones = new \Basket\Objects\Product('Headphones', 150);


$eventBus->addEvent(new \Basket\Events\CreateBasket($basket));
$eventBus->addEvent(new \Basket\Events\AddProductToBasket($basket, $mouse));
$eventBus->addEvent(new \Basket\Events\AddProductToBasket($basket, $monitor));
$eventBus->addEvent(new \Basket\Events\RemoveProductFromBasket($basket, $mouse));
$eventBus->addEvent(new \Basket\Events\AddProductToBasket($basket, $computer));
$eventBus->addEvent(new \Basket\Events\AddProductToBasket($basket, $mac));
$eventBus->addEvent(new \Basket\Events\AddProductToBasket($basket, $watch));
$eventBus->addEvent(new \Basket\Events\RemoveProductFromBasket($basket, $computer));
$eventBus->addEvent(new \Basket\Events\AddProductToBasket($basket, $headphones));


print_r($eventBus->serialize());

print_r($basket->getProducts());

print_r($basket->getTotalPrice() . PHP_EOL);