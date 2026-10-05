<?php

/***
 * Facade is a structural design pattern that provides a simplified interface
 * to a library, a framework, or any other complex set of classes.
 * without facade.
    $order = new Order();
    $inventory = new Inventory();
    $payment = new PaymentGateway();
    $notification = new Notification();

    $inventory->check($productId);
    $total = $order->calculateTotal($productId);

    $payment->charge($total);

    $order->create($productId);
    $notification->sendConfirmation();
 */
// Create one class that provides a simple interface to the complicated subsystem
class Inventory
{
    public function checkStock(int $productId): bool {
        echo "Checking Inventory...\n";

        return true;
    }
}

class PaymentGateway
{
    public function charge(float $amount): bool {
        echo "Charging $". $amount . "...\n";

        return true;
    }
}


class Order
{
    public function calculateTotal(int $productId): float
    {
        echo "Calculating order total...\n";

        return 100.00;
    }

    public function create(int $productId): void
    {
        echo "Creating order...\n";
    }
}

class Notification
{
    public function sendConfirmation(): void
    {
        echo "Sending confirmation email...\n";
    }
}
// Now create the Facade:

class CheckoutFacade
{
    public function __construct(
        private Inventory $inventory,
        private Order $order,
        private PaymentGateway $payment,
        private Notification $notification
    ) {}

    public function checkout(int $productId): bool {
        
        if(!$this->inventory->checkStock($productId)) {
            return false;
        }

        $total = $this->order->calculateTotal($productId);

        if(!$this->payment->charge($total)) {
            return false;
        }

        $this->order->create($productId);

        $this->notification->sendConfirmation();

        return true;
    }
}

// Now the controller only needs to know about one class:

$checkout = new CheckoutFacade(
    new Inventory(),
    new Order(),
    new PaymentGateway(),
    new Notification()
);

$checkout->checkout(101);

/***
                     Controller
                         |
                         v
                +----------------+
                | CheckoutFacade |
                +----------------+
                  /      |      \
                 /       |       \
                v        v        v
          Inventory    Order    Payment
                             
                         |
                         v
                    Notification
    
    * The Facade doesn't replace those classes. It simply provides a simpler entry point to the complicated subsystem.
    
    -- Disadvantages
    * Facade can become too large
     > If you keep adding unrelated operations, the Facade can become a God class.
    * Can hide complexity too much
     > Sometimes the client actually needs direct access to specific subsystem functionality.
     > A Facade shouldn't prevent that when direct access is appropriate.
    * Additional abstraction
     > For a very simple system, introducing a Facade can be unnecessary complexity.
    * Facade can become tightly coupled to subsystems
     > The Facade itself may need to know about many underlying services.
    * Not a replacement for good architecture
     > A Facade doesn't magically fix poorly designed classes or business logic.
 */