<?php

namespace VendingMachine\Money;

class MoneyCollection implements MoneyCollectionInterface {
    private $cash = [];

    public function add(MoneyInterface $money): void {
        array_push($this->cash, $money);
    }
    public function sum(): float {
        $sum = 0;
        for($i = 0; $i < count($this->cash); $i++) {
            $sum += $this->cash[$i]->getValue();
        }
        return $sum;
    }
    public function merge(MoneyCollectionInterface $moneyCollection): void {
        $this->cash = array_merge($this->cash, $moneyCollection->toArray());
    }
    public function empty(): void {
        $this->cash = array();
    }

    /**
     * @return MoneyInterface[]
     */
    public function toArray(): array {
        return $this->cash;
    }
}