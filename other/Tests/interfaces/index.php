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

    public function payNow() { return "Payed with PayPal"; }

    public function paymentProcess() {
        $this->loginFirst();
        $this->payNow();
    }
}

class BankTransfer implements PaymentInterface, LoginInterface {
    // PayPal users would have to login first
    public function loginFirst() {}

    public function payNow() {return "PayNow with BankTransfer";}

    public function paymentProcess() {
        $this->loginFirst();
        $this->payNow();
    }
}

class Visa implements PaymentInterface {
    public function payNow() {return "Payed with Visa";}
    public function paymentProcess() {
        $this->payNow();
    }
}

class Cash implements PaymentInterface {
    public function payNow() {return "Payed with cash";}
    public function paymentProcess() {
        $this->payNow();
    }
}
/**
 * In the BuyProduct class, 
 * the pay() method will call the paymentProcess() method
 * of the provided payment object
 * This class is using the PaymentInterface,
 * which means that any class implementing PaymentInterface can be passed to the pay() method.
 */
class BuyProduct {
    public function pay(PaymentInterface $paymentType){
        $paymentType->paymentProcess();
    }
    public function onlinePay(BankTransfer $paymentType) {
        $paymentType->paymentProcess();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inheritance</title>
</head>
<body>
    <?php
    $cashPay = new Cash();
    $paypalPay = new Paypal();
    $visaPay = new Visa();
    $banktransferPay = new BankTransfer();

    $dir = __DIR__;
    var_dump($dir);

    ?>
</body>
</html>