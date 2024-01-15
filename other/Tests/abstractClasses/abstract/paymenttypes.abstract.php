<?php

// only BuyProduct Class needs to access the Visa class
abstract class Visa {
    public function visaPayment() {
        return "Perform a payment";
    }

    abstract public function getPayment();
}