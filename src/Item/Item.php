<?php

namespace VendingMachine\Item;

use VendingMachine\Item\ItemInterface;
use VendingMachine\Item\ItemCollection;
use VendingMachine\Exception\InvalidInputException;

class Item implements ItemInterface {
    private $symbol;
    private $count;
    private $price;

    public function __construct(string $symbol, int $count, float $price) {
        $getAvailableItems = ItemCollection::getAvailableItems();
        if(!in_array($symbol, array_keys($getAvailableItems))) {
            throw new InvalidInputException("You have tried to add an invalid item [name: " . $symbol . "]. Check ItemCollection if u want add new item type.");
        } else if($getAvailableItems[$symbol] != $price) {
            throw new InvalidInputException("You have tried to add an item with an unauthorized price [name: " . $symbol . "]. Check ItemCollection if u want change price.");
        }
        $this->symbol = $symbol;
        $this->setCount($count);
        $this->setPrice($price);
    }

    public function getCount(): int {
        return $this->count;
    }
    public function setCount(int $count): void {
        $this->count = $count;
    }
	public function getPrice(): float {
        return $this->price;
    }
    public function setPrice(float $price): void {
        $this->price = $price;
    }
    public function getSymbol(): string {
        return $this->symbol;
    }
}