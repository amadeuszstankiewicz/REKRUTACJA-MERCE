<?php

namespace VendingMachine\Money;
use VendingMachine\Exception\InvalidInputException;

class Money implements MoneyInterface {
    private $value;
    private $symbol;

    public function __construct(string $symbol) {
        switch ($symbol) {
            case 'N':
                $this->symbol = $symbol;
                $this->value = 0.05;
                break;
            case 'D':
                $this->symbol = $symbol;
                $this->value = 0.1;
                break;
            case 'Q':
                $this->symbol = $symbol;
                $this->value = 0.25;
                break;
            case 'DOLLAR':
                $this->symbol = $symbol;
                $this->value = 1.00;
                break;
            default:
                throw new InvalidInputException("You are inserting the wrong value.\n");
        }
    }

    public function getValue(): float {
        return $this->value;
    }
    public function getSymbol(): string {
        return $this->symbol;
    }
}