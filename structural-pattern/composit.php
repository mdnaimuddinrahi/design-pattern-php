<?php
/***
 * Composit is a structural design pattern that lets you compose objects
 * into tree structures and then work with these structures as if they
 * were individual objects.
 * 
 * 
 * Pros: flexibility, reusable structure, less conditional code, 
   and easy handling of products + combos.
 * Cons: more abstraction and complexity, and it's unnecessary 
   if your POS doesn't have hierarchical product structures.
 */
// 1. Component
interface OrderItem
{
    public function getName(): string;
    public function getPrice(): float;
}

// 2. Leaf —— Product

class Product implements OrderItem
{
    public function __construct(
        private string $name,
        private float $price
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    #[Override]
    public function getPrice(): float
    {
        return $this->price;
    }
}

// 3. Composite —— Combo

class Combo implements OrderItem
{
    private array $items = [];

    public function __construct(
        private string $name,
    ) {}

    public function add(OrderItem $item): void {
        $this->items[] = $item;
    }

    #[Override]
    public function getName(): string
    {
        return $this->name;
    }

    #[Override]
    public function getPrice(): float
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getPrice();
        }

        return $total;
    }
}

// 4. Using it in the POS

$burger = new Product("Burger", 250);
$fries = new Product("Fries", 100);
$coke = new Product("Coke", 60);

$combo = new Combo("Burger Combo");

$combo->add($burger);
$combo->add($fries);
$combo->add($coke);

echo $combo->getName(). ": ". $combo->getPrice();

/**
 * Output
 * Burger Combo: 410
 */

$familyMeal = new Combo("Family Meal");
$familyMeal->add($combo);
$familyMeal->add(new Product("Extra Chicken", 180));

echo $familyMeal->getPrice();


/***
 * The structure is 
    OrderItem
    │
    ├── Product
    │     ├── Burger
    │     ├── Fries
    │     └── Coke
    │
    └── Combo
            │
            ├── Burger
            ├── Fries
            └── Coke
 */