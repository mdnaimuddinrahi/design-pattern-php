<?php
/***
 * Prototype is a creational design pattern that lets you copy existing
   objects without making your code dependent on their classes.
 * 
 * Pros:
    * Reduces expensive object initialization: useful when creating an
      involves costly setup.
    * Avoid repeated configuration: common state/configuration is defined
      once in the prototype.
    * Creates customized copies easily: clone the prototype and modify only
      the required properties.
    * Reduces coupling to concrete classes: client code can work with a 
      prototype instead of knowing all construction details. 
 * Cons:
    * Deep cloning can be difficult: nested objects may require explicit
      cloning.
    * Shallow-copy problems: in PHP, clone does not automatically clone
      referrenced objects.
    * Can increase complexity unnecessarily: for simple objects, normal
      instantiation is usually clearer.
    * Clone behaviour must be maintained: if the object's internal structure
      changes, cloning logic may also need changes.
      
      -- Prototype is useful when object creation is expensive or complex and 
      many similar objects are required. it's main drawback is that cloning
      becomes complicated when the object contains nested or shared objects,
      especially when deep copying is required.
      
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