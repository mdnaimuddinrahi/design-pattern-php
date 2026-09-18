<?php

/***
 * Builder is a creational design pattern that lets you construct
   complex objects step by step. The pattern allows you to produce
   different types and representations of an object using the same 
   construction code.

 * Pros 
    1. You can construct objects step-by-step, defer construction steps or 
    run steps recursively.
    2. You can reuse the same construction code when building various 
    representations of products.
    3. Single Responsibility Principle. You can isolate complex construction
    code from the business logic of the product.
  * Cons
    1. The overall complexity of the code increases since the pattern
    requires creating multiple new classes.

  * The easiest way to understand it is:
    Factory decides which object to create.Builder decides how to
    construct a complex object.
  * Factory → chooses what to create.
  * Abstract Factory → chooses a family of related objects.
  * Builder → controls how one complex object is constructed.
 */

class Payment
{
    public function __construct(
        private float $amount,
        private string $currency,
        private string $customerId,
        private string $paymentMethod,
        private ?string $description = null,
        private ?string $billingAddress = null,
        private ?string $receiptEmail = null,
        private array $metadata = [],
    ) {}

    public function process(): void
    {
        echo "Payment processed successfully.\n";
        echo "Amount: {$this->amount} {$this->currency}\n";
        echo "Customer: {$this->customerId}\n";
        echo "Method: {$this->paymentMethod}\n";
    }
}

class PaymentBuilder
{
    private float $amount;
    private string $currency;
    private string $customerId;
    private string $paymentMethod;
    private ?string $description;
    private ?string $billingAddress;
    private ?string $receiptEmail;
    private array $metadata;

    public function setAmount(float $amount): PaymentBuilder
    {
        $this->amount = $amount;
        return $this;
    }

    public function setCurrency(string $currency): PaymentBuilder
    {
        $this->currency = $currency;
        return $this;
    }

    public function setCustomerId(string $customerId): PaymentBuilder
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function setPaymentMethod(string $paymentMethod): PaymentBuilder
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function setDescription(string $description): PaymentBuilder
    {
        $this->description = $description;
        return $this;
    }

    public function setBillingAddress(string $billingAddress): PaymentBuilder
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    public function setReceiptEmail(string $receiptEmail): PaymentBuilder
    {
        $this->receiptEmail = $receiptEmail;
        return $this;
    }

    public function addMetadata(string $key, mixed $value): self
    {
        $this->metadata[$key] = $value;

        return $this;
    }

    public function build(): Payment
    {
        if ($this->amount === null) {
            throw new InvalidArgumentException('Payment amount is required.');
        }

        if ($this->currency === null) {
            throw new InvalidArgumentException('Currency is required.');
        }

        if ($this->customerId === null) {
            throw new InvalidArgumentException('Customer ID is required.');
        }

        if ($this->paymentMethod === null) {
            throw new InvalidArgumentException('Payment method is required.');
        }

        return new Payment(
            amount: $this->amount,
            currency: $this->currency,
            customerId: $this->customerId,
            paymentMethod: $this->paymentMethod,
            description: $this->description,
            billingAddress: $this->billingAddress,
            receiptEmail: $this->receiptEmail,
            metadata: $this->metadata,
        );
    }
}

$payment = (new PaymentBuilder())
    ->setAmount(100)
    ->setCurrency('USD')
    ->setCustomerId('CUS-123')
    ->setPaymentMethod('card')
    ->setDescription('Order payment')
    ->setBillingAddress('Dhaka, Bangladesh')
    ->setReceiptEmail('rahi@example.com')
    ->addMetadata('order_id', 'ORD-1001')
    ->build();

$payment->process();