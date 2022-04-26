<?php

namespace VendingMachine\Response;

use VendingMachine\Response\ResponseInterface;

class Response implements ResponseInterface {
    private $returnCode;
    private $result;

    public function __construct(int $returnCode, $result) {
        $this->returnCode = $returnCode;
        $this->result = $result;
    }

    public function __toString(): string {
        if(is_array($this->result)) {
            $returnString = "";
            for($i = 0; $i < count($this->result); $i++) {
                $returnString .= $this->result[$i]->getSymbol();
                if($i < count($this->result)-1) {
                    $returnString .= ', ';
                }
            }
            return $returnString;
        }
        return $this->result;
    }
    public function getReturnCode(): int {
        return $returnCode;
    }
}