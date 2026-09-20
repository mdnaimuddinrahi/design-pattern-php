<?php
/***
 * Prototype is a creational design pattern that lets you copy existing
   objects without making your code dependent on their classes.
 * 
 */
class Payment {
    public function __construct(
        public string $gateway,
        public string $currency,
        public float $amount,
        public string $status
    ) {}

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }
}

// Create the original object
$payment = new Payment(
    gateway: 'Stripe',
    currency: 'USD',
    amount: 100.0,
    status: 'Pending'
);


// clone the payment
$payment2 = clone $payment;

// change only what is different
$payment2->gateway = 'PayPal';
// $payment2->setAmount(200.0);

// check the results
print_r($payment);
print_r($payment2);