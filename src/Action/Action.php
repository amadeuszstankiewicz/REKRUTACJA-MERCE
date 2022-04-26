<?php

namespace VendingMachine\Action;

use VendingMachine\Action\ActionInterface;
use VendingMachine\Money\Money;
use VendingMachine\Item\Item;
use VendingMachine\Item\ItemCollection;
use VendingMachine\Response\Response;
use VendingMachine\Response\ResponseInterface;
use VendingMachine\VendingMachineInterface;

class Action implements ActionInterface
{
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function handle(VendingMachineInterface $vendingMachine): ResponseInterface {
        if($this->name === "N" || $this->name === "D" ||
            $this->name === "Q" || $this->name=== "DOLLAR") {
            $cash = new Money($this->name);
            $vendingMachine->insertMoney($cash);

            return new Response(200, number_format($vendingMachine->getInsertedMoney()->sum(), 2));
        } else if($this->name === "RETURN-MONEY") {
            return new Response(200, $vendingMachine->getInsertedMoney()->toArray());
        } else if(substr($this->name, 0, 4) === "GET-") {
            $itemName = substr($this->name, 4);
            $itemPrice = ItemCollection::getAvailableItems()[$itemName];
            $vendingMachine->dropItem(new Item($itemName, 1, $itemPrice));
            return new Response(200, $itemName);
        } else {
            return new Response(400, "Unknown input.");
        }

        return new Response(400, "Unknown error.");
    }
    public function getName(): string {
        return $this->name;
    }
}
