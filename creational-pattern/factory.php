<?php
/***
Factory Method is a creational design pattern that provides an interface
for creating objects in a superclass, but allows subclasses to alter type of 
objects that will be created. 

Use it when you have:
** One job, but multiple implements.

For example:
             Payment
                │
       ┌────────┼────────┐
       ↓        ↓        ↓
     Cash      Card    Mobile Banking App

*/


/*** 
 * Step 1 - Create the Payment interface
 * Every payment should have a pay() method
*/
interface Payment
{
    public function pay(float $amount): void;
}

/***
 * Step - 2 ——— Create different payment classes
 */
// cash
class CashPayment implements Payment
{
    public function pay(float $amount): void {
        echo "Paid {$amount} BDT using Cash.";
    }
}
// card
class CardPayment implements Payment
{
    public function pay(float $amount): void
    {
        echo "Paid {$amount} BDT using Card.";
    }
}
// MobileBankingApp
class MobileBankingApp implements Payment
{
    public function pay(float $amount): void {
        echo "Paid {$amount} BDT using Mobile Banking App.";
    }
}

/***
 * Step - 3 ——— Create the Factory 
 * The Factory job is:
 * Receive the payment type → create the correct payment object → return it.
 */
class PaymentFactory
{
    public static function create(string $method): Payment
    {
        return match ($method) {
            'cash' => new CashPayment(),
            'card' => new CardPayment(),
            'mobile' => new MobileBankingApp(),
            default => throw new InvalidArgumentException(
                "Unsupported payment method"
            )
        };   
    }
}

/***
 * Step - 4 ——— Use it in your POS
 * Imagine your POS receives:
 */

$method = 'mobile';
$amount = 1500;

// Without  a factory
if ($method === 'cash') {
    $payment = new CashPayment();
}

if ($method === 'card') {
    $payment = new CardPayment();
}

if ($method === 'bkash') {
    $payment = new MobileBankingApp();
}

$payment->pay($amount);

// with a factory 

$payment = PaymentFactory::create($method);
$payment->pay($amount);
/*** 
 * Output
 * Paid 1500 BDT using Mobile Banking App.
 */

