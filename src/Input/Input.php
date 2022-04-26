<?php

namespace VendingMachine\Input;

use VendingMachine\Exception\InvalidInputException;
use VendingMachine\Money\MoneyCollectionInterface;
use VendingMachine\Action\ActionInterface;
use VendingMachine\Action\Action;
use VendingMachine\Item\ItemCollection;

class Input implements InputHandlerInterface, InputParserInterface, InputInterface {
    private $vendingMachine;
    private $action;

    private static $availableInputs = ["N", "Q", "D", "DOLLAR", "RETURN-MONEY"];

    public function __construct($vendingMachine, $action) {
        $this->vendingMachine = $vendingMachine;
        $this->action = $action;
    }

    /**
     * @throws InvalidInputException
     */
	public function getInput(): InputInterface {
        $inputName = $this->getAction()->getName();
        $availableItems = array_keys(ItemCollection::getAvailableItems());
        if(in_array($inputName, self::$availableInputs)) {
            return $this;
        }
        if(substr($inputName, 0, 4) === 'GET-' && in_array(substr($inputName, 4), $availableItems)) {
            return $this;
        }
        throw new InvalidInputException("Invalid input.");
    }

    public function parse(string $input): InputInterface {
        //TODO: parse $input
        return $this;
    }

    public function getMoneyCollection(): MoneyCollectionInterface {
        return $this->vendingMachine->getInsertedMoney();
    }
	public function getAction(): ActionInterface {
        return $this->action;
    }
}
