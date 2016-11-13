<?php

class Collection
{
    public $count = 0;
    public $items = [];

    public function isEmpty()
    {
        return $this->size() === 0;
    }

    public function size()
    {
        return $this->count;
    }

    public function add($item)
    {
        array_push($this->items, $item);
        ++$this->count;
    }

    public function remove($item)
    {
        for ($i = 0; $i < $this->size(); ++$i) {
            if ($this->items[$i] == $item) {
                $this->items[$i] = null;
                $this->items[$i] = $this->items[--$this->count];
                return;
            }
        }
    }

    public function contains($item)
    {
        foreach ($this->items as $i) {
            if ($item == $i) {
                return true;
            }
        }

        return false;
    }
}