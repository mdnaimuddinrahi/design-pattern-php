<?php

/***
 * The abstract factory pattern is a creational design pattern that lets
 * you produce families of related or dependent objects without specifying
 * their concrete classes.
 * 
 */
interface Payment 
{
    public function pay(float $amount): void;
}

interface Refund
{
    public function refund(string $transactionId): void;
}

class StripePayment implements Payment
{
    public function pay(float $amount): void
    {
        echo "Stripe: Payment of $$amount completed.\n";
    }
}

class StripeRefund implements Refund
{
    public function refund(string $transactionId): void
    {
        echo "Stripe: Refund for transaction  $transactionId completed.\n";
    }
}

class PayPalPayment implements Payment
{
    public function pay(float $amount): void
    {
        echo "PayPal: Payment of $$amount completed.\n";
    }
}

class PayPalRefund implements Refund
{
    public function refund(string $transactionId): void
    {
        echo "PayPal: Refund for transaction $transactionId completed.\n";
    }
}

interface PaymentFactory
{
    public function createPayment(): Payment;
    public function createRefund(): Refund;
}

class StripeFactory implements PaymentFactory
{
    public function createPayment(): Payment
    {
        return new StripePayment();
    }

    public function createRefund(): Refund
    {
        return new StripeRefund();
    }
}


class PayPalFactory implements PaymentFactory
{
    public function createPayment(): Payment
    {
        return new PayPalPayment();
    }

    public function createRefund(): Refund
    {
        return new PayPalRefund();
    }
}



// ========================================
// 7. Application / Client Code
// ========================================

function checkout(PaymentFactory $factory): void
{
    $payment = $factory->createPayment();

    $payment->pay(100);

    echo "----------------------\n";

    $refund = $factory->createRefund();

    $refund->refund("TXN-12345");
}


// ========================================
// 8. Test
// ========================================

echo "STRIPE\n";
checkout(new StripeFactory());

echo "\n";

echo "PAYPAL\n";
checkout(new PayPalFactory());

/***
 * Now understand what actually happened

This line:

checkout(new StripeFactory());

means:

"Use the Stripe family."

The factory creates:

StripeFactory
     ↓
StripePayment
StripeRefund

Then:

checkout(new PayPalFactory());

means:

"Use the PayPal family."

The factory creates:

PayPalFactory
     ↓
PayPalPayment
PayPalRefund
The most important part

Look at this function:

function checkout(PaymentFactory $factory): void
{
    $payment = $factory->createPayment();

    $payment->pay(100);

    $refund = $factory->createRefund();

    $refund->refund("TXN-12345");
}

Notice something important:

There is no:

new StripePayment();

and no:

new PayPalPayment();

inside checkout().

That's the benefit.

checkout() doesn't know which payment provider is being used.

It only knows:

PaymentFactory
 */