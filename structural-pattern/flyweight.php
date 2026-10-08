<?php
/***
 * Flyweight is a structural design pattern that lets you fit more objects
 * into the available amount of RAM by sharing common parts of state between
 * multiple objects instead of keeping all of the data in each object.
 * it's main purpose is saving memory by sharing common data between many objects.
 * 
 * Cons:
 * 1. Increases code complexity: must manage shared objects.
 * 2. Requires careful separation of state:
 *      # Intrinsic state -> shared
 *      # Extrinsic state -> unique to each usage
 * 3. Shared mutable state can cause bugs: if a shared Flyweight is modified.
 *      every user of that of object may see the change. 
 * 4. Factory/cache itself consumes memory: 
 *      # The factory has to keep references to the shared objects.
 *      # If almost every object is unique, there may be little benefit.
 * 5. Can make debugging harder: Multiple parts of the application may
 *      reference the same object, so changes can have unexpected effects.
 * 6. May be unnecessary for small applications:
 *      if have a small number of objects, the added complexity isn't worth
 *      the memory saving.
 * In shortly:
 * It increases complexity, requires careful separation of intrinsic 
 * and extrinsic state, and shared mutable objects can cause unexpected 
 * side effects.
 * 
 */
class Product
{
    public function __construct(
        private string $name,
        private float $price
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

class ProductFactory
{
    private array $products = [];

    public function getProduct(
        string $name,
        float $price
    ) {
        $key = $name. ":" . $price;

        if(!isset($this->products[$key])) {
            $this->products[$key] = new Product($name, $price);
        }

        return $this->products[$key];
    }
}

class OrderItem
{
    public function __construct(
        private Product $product,
        private int $quantity
    ) {}

    public function getTotal() : float {
        return $this->product->getPrice() * $this->quantity;
    }
}
/***
                   ProductFactory
                       |
             +---------+---------+
             |                   |
        "Burger:250"        "Pizza:400"
             |                   |
             v                   v
        Product Object       Product Object
             |
       +-----+------+
       |            |
       v            v
   OrderItem     OrderItem
   quantity: 2   quantity: 5
 */