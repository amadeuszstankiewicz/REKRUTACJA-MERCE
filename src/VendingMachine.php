<?php

namespace VendingMachine;

use VendingMachine\Action\ActionInterface;
use VendingMachine\Item\Item;
use VendingMachine\Item\ItemCollection;
use VendingMachine\Item\ItemInterface;
use VendingMachine\Money\Money;
use VendingMachine\Money\MoneyCollection;
use VendingMachine\Money\MoneyCollectionInterface;
use VendingMachine\Money\MoneyInterface;
use VendingMachine\Response\ResponseInterface;
use VendingMachine\Exception\ItemNotFoundException;

class VendingMachine implements VendingMachineInterface {
    private $itemCollection;
    private $moneyCollection;

    public function __construct() {
        $this->itemsCollection = new ItemCollection();
        $this->moneyCollection = new MoneyCollection();
    }

    public function addItem(ItemInterface $item): void {
        try {
            $this->itemsCollection->add($item);
        } catch(Exception $e) {
            echo $e->getMessage() . "\n";
        }
        return;
    }
    public function dropItem(ItemInterface $item): void {
        try {
            if($item->getPrice() > $this->getInsertedMoney()->sum()) throw new ItemNotFoundException("Not enough money.");
            $this->itemsCollection->get($item);
        } catch(Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
    public function insertMoney(MoneyInterface $money): void {
        $this->moneyCollection->add($money);
    }
    public function getInsertedMoney(): MoneyCollectionInterface {
        return $this->moneyCollection;
    }
    public function handleAction(ActionInterface $action): ResponseInterface {
        return $action->handle($this);
    }

    
    //ADDITIONAL FUNCTIONS
    public function coinReturnDisplay(string $itemType): void {
        $returnValue = intval($this->getInsertedMoney()->sum() * 100);

        $returnValue -= intval(ItemCollection::getAvailableItems()[$itemType] * 100);

        echo "Return coins: ";
        while($returnValue > 0) {
            if($returnValue >= 100) {
                $returnValue -= 100;
                echo "DOLLAR";
            } else if($returnValue >= 25) {
                $returnValue -= 25;
                echo "Q";
            } else if($returnValue >= 10) {
                $returnValue -= 10;
                echo "D";
            } else if($returnValue >= 5) {
                $returnValue -= 5;
                echo "N";
            }

            if($returnValue > 0) {
                echo ", ";
            }

        }
        echo "\n";
    }
}