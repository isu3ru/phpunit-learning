<?php

namespace App\Support;

use ArrayIterator;
use IteratorAggregate;
use JsonSerializable;

class Collection implements IteratorAggregate, JsonSerializable
{
    
    protected $items = [];

    public function __construct(array $items = []) {
        $this->items = $items;
    }

    public function all()
    {
        return $this->items;
    }

    public function count()
    {
        return count($this->items);
    }

    public function get(int $itemIndex)
    {
        return $this->items[$itemIndex];
    }

    public function isEmpty()
    {
        return $this->count() == 0;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public function add(array $items)
    {
        $this->items = array_merge($this->items, $items);
    }

    public function merge(Collection $collection)
    {
        return $this->add($collection->all());
    }

    public function remove(int $index)
    {
        array_splice($this->items, $index, 1);
    }

    public function toJson()
    {
        return json_encode($this->all());
    }

    public function jsonSerialize()
    {
        return $this->items;
    }
}
