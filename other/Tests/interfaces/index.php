<?php
declare(strict_types=1);

// Interfaces

// create an interface which groups the paymentOptions
interface PaymentInterface {
    public function paymentProcess();
}

interface LoginInterface {
    public function loginFirst();
}

class Paypal implements PaymentInterface, LoginInterface {
    // PayPal users would have to login first
    public function loginFirst() {}

    public function payNow() {}

    public function paymentProcess() {
        $this->loginFirst();
        $this->payNow();
    }
}

class BankTransfer implements PaymentInterface, LoginInterface {
    // PayPal users would have to login first
    public function loginFirst() {}

    public function payNow() {}

    public function paymentProcess() {
        $this->loginFirst();
        $this->payNow();
    }
}

class Visa implements PaymentInterface {
    public function payNow() {}
    public function paymentProcess() {
        $this->payNow();
    }
}

class Cash implements PaymentInterface {
    public function payNow() {}
    public function paymentProcess() {
        $this->payNow();
    }
}

class BuyProduct {
    public function pay(PaymentInterface $paymentType){
        $paymentType->paymentProcess();
    }
    public function onlinePay(BankTransfer $paymentType) {
        $paymentType->paymentProcess();
    }
}