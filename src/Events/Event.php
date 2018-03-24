<?php


namespace Basket\Events;


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
