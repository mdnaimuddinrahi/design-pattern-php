<?php

/***
 * The Adapter Pattern allows two incompatible classes/interfaces to work 
 * together by converting one interface into another that the client expects.
 * For example: 
 * in applicatoin expects every payment gateway to have a pay() method, but
 * a third-party gateway provides makePayments() instead.
 * 
 * Problem 
 * Imagine your Laravel application supports:
 *      Stripe
 *      PayPal
 *      bKash
 *      SSLCommerz
 * The problem is that each gateway has a different API
 * without Adapter
 * classs Stripe { public function charge($amount) {} }
 * class Paypal { public function makePayment($amount) {} }
 * class Bkash { public function createPayment($amount) {} }
 *      Now your OrderService needs to know about all of them:
 * class OrderService
 *   {
 *       public function pay($gateway, $amount)
 *       {
 *           if ($gateway instanceof Stripe) {
 *               return $gateway->charge($amount);
 *           }
 *
 *           if ($gateway instanceof PayPal) {
 *               return $gateway->makePayment($amount);
 *           }
 *
 *           if ($gateway instanceof Bkash) {
 *               return $gateway->createPayment($amount);
 *           }
 *       }
 *   }
 * This becomes ugly very quickly. If want to add another gateway 
 *
 *     
                  YOUR APPLICATION
                         ↓
                 PaymentGateway
                  pay($amount)
                         ↑
          ┌──────────────┼──────────────┐
          │              │              │
          ↓              ↓              ↓
   StripeAdapter    PayPalAdapter   BkashAdapter
          ↓              ↓              ↓
       Stripe          PayPal         bKash
     charge()       makePayment()   createPayment() 
 */

interface PaymentGateway
{
    public function pay(float $amount): bool;
}

// Third-party payment service
class Stripe
{
    public function charge(float $amount): bool
    {
        echo "Stripe payment: $". $amount. PHP_EOL;

        return true;
    }
}

class Paypal
{
    public function makePayment(float $amount): bool
    {
        echo "Paypal payment: $". $amount. PHP_EOL;

        return true;
    }
}

class Bkash 
{
    public function createPayment(float $amount): bool
    {
        echo "Bkash payment: $". $amount. PHP_EOL;

        return true;
    }
}



// Adapter
class StripeAdapter implements PaymentGateway
{
    public function __construct(
        private Stripe $stripe
    ) {}

    public function pay(float $amount): bool
    {
        return $this->stripe->charge($amount);
    }
}

class PaypalAdapter implements PaymentGateway
{
    public function __construct(
        private Paypal $paypal
    ) {}

    public function pay(float $amount): bool
    {
        return $this->paypal->makePayment($amount);
    }
}

class BkashAdapter implements PaymentGateway
{
    public function __construct(
        private Bkash $bkash
    ) {}

    public function pay(float $amount): bool
    {
        return $this->bkash->createPayment($amount);
    }
}

//Client
class OrderService
{
    public function __construct(
        private PaymentGateway $paymentGateway
    ) {}

    public function checkout(float $amount): void
    {
        if ($this->paymentGateway->pay($amount)) {
            echo "Payment successful";
        }
    }
}

// Usage
$stripe = new Stripe();

$paymentGateway = new StripeAdapter($stripe);

$orderService = new OrderService($paymentGateway);

$orderService->checkout(100);