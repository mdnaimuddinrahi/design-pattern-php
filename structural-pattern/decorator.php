<?php
/***
 * Decorator is a structural design pattern that lets you attach new
 * behaviors to objects by placing these objects inside special wrapper
 * objects that contain the behaviors.
 */
namespace App\Receipt;

interface Receipt
{
    public function print(): string;
}

// Concrete component:
class BasicReceipt implements Receipt
{
    public function print(): string
    {
        return "Burger - $250";
    }
}

// Decorator:
abstract class ReceiptDecorator implements Receipt
{
    public function __construct(
        protected Receipt $receipt
    ) {}

    public function print(): string
    {
        return $this->receipt->print();
    }
}

// tax section
class TaxReceipt extends ReceiptDecorator
{
    public function print(): string
    {
        return $this->receipt->print(). "\nTax: $25";
    }
}

class CustomerReceipt extends ReceiptDecorator
{
    public function print(): string
    {
        return $this->receipt->print()."\nCustomer: Rahi";
    }
}

$receipt = new BasicReceipt();
$receipt = new TaxReceipt($receipt);
$receipt = new CustomerReceipt($receipt);

echo $receipt->print();

// Output
/***
    Burger - $250
    Tax: $25
    Customer: Rahi
                 Receipt
                    ▲
                    │
        ┌───────────┴───────────┐
        │                       │
 BasicReceipt          ReceiptDecorator
                                ▲
                                │
                     ┌──────────┴──────────┐
                     │                     │
                TaxReceipt          CustomerReceipt
 */