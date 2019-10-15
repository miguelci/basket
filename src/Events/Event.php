<?php
declare(strict_types=1);

namespace Basket\Events;

interface Event
{
    public function apply(): void;
    public function serialize(): string;
}
