<?php

namespace VendingMachine\Item;

use VendingMachine\Item\ItemCollectionInterface;
use VendingMachine\Exception\ItemNotFoundException;

class ItemCollection implements ItemCollectionInterface {
    /*SET AVAILABLE ITEMS
        "name" => price
    */
    private static $availableItems = 
    [
        "A" => 0.65,
        "B" => 1.0,
        "C" => 1.5
    ];

    private $items = [];

    public function add(ItemInterface $item): void {
        for($i = 0; $i<count($this->items); $i++) {
            if($this->items[$i]->getSymbol() === $item->getSymbol()) {       //CHECKS IF USER TRIES ADD SAME SYMBOL ITEM
                if($this->items[$i]->getPrice() === $item->getPrice()) {     //IF PRICE IS THE SAME JUST ADD COUNT
                    $this->items[$i]->setCount($this->items[$i]->getCount() + $item->getCount());
                    return;
                } else {
                    throw new ItemNotFoundException("You are trying to add an existing item with a different price.\n");
                }
            }
        }
        array_push($this->items, $item);
        return;
    }

    /**
     * @throws ItemNotFoundException
     */
    public function get(ItemInterface $item): ItemInterface {
        for($i = 0; $i < count($this->items); $i++) {
            if($this->items[$i]->getSymbol() === $item->getSymbol() && $this->items[$i]->getCount() > 0) {
                $this->items[$i]->setCount($this->items[$i]->getCount() - 1);
                return $this->items[$i];
            }
        }
        throw new ItemNotFoundException("Item not found. Please choose another item.");
    }

    public function count(ItemInterface $item): int {
        for($i = 0; $i < count($this->items); $i++) {
            if($this->items[$i]->getSymbol() === $item->getSymbol()) {
                return $this->items[$i]->getCount();
            }
        }
    }

    public function empty(): void {
        $this->items = array();
    }


    public static function getAvailableItems() {
        return self::$availableItems;
    }
}