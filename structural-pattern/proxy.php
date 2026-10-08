<?php

/***
 * proxy is a structural design pattern that lets you provide a substitute 
 * or placeholder for another object. A proxy controls access to the original
 * object. A proxy controls access to the original object, allowing you to 
 * perform something either before of after the request gets through to 
 * the original object.
 * Proxy
 *  Controller
        ↓
    PaymentProxy
        ↓
    BankPaymentService
        ↓
    Bank API
 * Why do we need a Proxy?
 * The main reason is control over access to another object.
 * A Proxy can:
 * 1. Delay creating an expensive object(lazy loading).
 * 2. Check permissions (protection proxy)
 * 3. Cache results (caching proxy)
 * 4. Log requests
 * 5. Control remote API/service calls (remote proxy)
 * 6. Prevent unnecessary operations.
 * 
 * A Proxy stands in front of a real object and controls access to it.
 * 
 * Pros:
 *  > Controls access to the real object.
 *  > Keeps access-related logic separate.
 *  > Client doesn't need to know about the real object's access rules.
 *  > Can also be extended for caching, logging, lazy loading, etc.
 * Cons:
 *  > Adds an extra class/layer.
 *  > Can make a simple system unnecessarily complicated.
 *  > Debugging can involve an additional layer.
 */
interface PaymentService
{
    public function pay(float $amount): string;
}

class BankPaymentService implements PaymentService
{
    public function pay(float $amount): string
    {
        // call the actual bank API here.

        return "Paid $amount successfully";
    }
}

class PaymentProxy implements PaymentService
{
    public function __construct(
        private BankPaymentService $paymentService,
        private bool $isAuthorized
    ) {}

    public function pay(float $amount):string
    {
        if(!$this->isAuthorized) {
            return "Payment denied.";
        }

        return $this->paymentService->pay($amount);
    }
}


$payment = new PaymentProxy(
    new BankPaymentService(),
    true
);

echo $payment->pay(1000);

/***
 * Output
 * Paid 1000 successfully.
 */

$payment = new PaymentProxy(
    new BankPaymentService(),
    false
);

echo $payment->pay(1000);

/**
 * Output
 * Payment denied.d
 */