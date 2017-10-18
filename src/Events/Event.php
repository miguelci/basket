<?php
/**
 * FutureFuel
 *
 * IEvent.php
 * Created on 18/10/17
 *
 * Miguel Heitor - miguel@futurefuel.io
 */

namespace Basket\Events;

/**
 * Interface Event
 * @package Basket\Events
 */
interface Event
{

    /**
     * Will execute the needed function for each event.
     */
    public function apply();

    /**
     * Returns the object in a readable way
     *
     * @return string
     */
    public function serialize();

}