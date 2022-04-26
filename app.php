<?php

require_once 'vendor/autoload.php';
use VendingMachine\VendingMachine;
use VendingMachine\Action\Action;
use VendingMachine\Input\Input;
use VendingMachine\Item\Item;
use VendingMachine\Item\ItemCollection;

$vendingMachine = new VendingMachine();
/* ADD ITEMS */
try {
    $vendingMachine->addItem(new Item('A', 1, 0.65));
    $vendingMachine->addItem(new Item('B', 1, 1.0));
    $vendingMachine->addItem(new Item('C', 1, 1.5));
} catch(Exception $e) {
    echo $e->getMessage() . "\n";
}
///////////////

echo "--- Vending machine program (to exit, type exit) ---\n";
$inputString = "";
while($inputString != "exit") {
    $inputString = readline("Input: ");
    if($inputString == "exit") break;

    if($inputString == 'N' || $inputString == 'D' || $inputString == 'Q' || $inputString == 'DOLLAR') {
        echo "Current balance: ";
        try {
            $input = new Input($vendingMachine, new Action($inputString));
            $response = $vendingMachine->handleAction($input->getInput()->getAction());
        
            echo $response;
            $moneyArr = $vendingMachine->getInsertedMoney()->toArray();
            echo " (";
            for($i = 0; $i < count($moneyArr); $i++) {
                echo $moneyArr[$i]->getSymbol();
                if($i != count($moneyArr)-1) {
                    echo ", ";
                } else {
                    echo ")\n";
                }
            }
        } catch(Exception $e) {
            echo $e->getMessage() . "\n";
        }
    } else if($inputString == 'RETURN-MONEY') {
        try {
            $input = new Input($vendingMachine, new Action($inputString));
            $response = $vendingMachine->handleAction($input->getInput()->getAction());
            echo $response . "\n";
            $vendingMachine->getInsertedMoney()->empty();
        } catch(Exception $e) {
            echo $e->getMessage() . "\n";
        }
    } else if(substr($inputString, 0, 4) === 'GET-') {
        if(in_array(substr($inputString, 4), array_keys(ItemCollection::getAvailableItems()))) {
            try {
                $input = new Input($vendingMachine, new Action($inputString));
                $response = $vendingMachine->handleAction($input->getInput()->getAction());
                echo $response . "\n";
    
                //COIN RETURN
                echo $vendingMachine->coinReturnDisplay(substr($inputString, 4));
                /////////////
                $vendingMachine->getInsertedMoney()->empty();
            } catch(Exception $e) {
                echo $e->getMessage() . "\n";
            }
        } else {
            echo "Item does not exists.\n";
        }
    } else {
        echo "Invalid input.\n";
    }
}