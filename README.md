# 🧩 Design Patterns in PHP

> 🚀 Learning **Software Design Patterns** with practical PHP examples.

[![PHP](https://img.shields.io/badge/PHP-8%2B-777BB4?logo=php\&logoColor=white)](https://www.php.net/)
[![Design Patterns](https://img.shields.io/badge/Design%20Patterns-Learning-blue)]()
[![Status](https://img.shields.io/badge/Status-Learning-orange)]()

---

## 💡 What is a Design Pattern?

A **Design Pattern** is a reusable solution to a common software design problem.

Think of it as a **blueprint**, not ready-made code.

```text
             🧩 DESIGN PATTERN
                    │
        ┌───────────┼───────────┐
        ↓           ↓           ↓
      Problem     Solution    Structure
        │           │           │
        └───────────┼───────────┘
                    ↓
              Better Design
```

> 🧠 **Pattern = How to organize your code to solve a recurring problem.**

---

## ⚡ Pattern vs Algorithm

| 🧩 Design Pattern              | ⚙️ Algorithm                  |
| ------------------------------ | ----------------------------- |
| High-level solution            | Step-by-step solution         |
| Focuses on code structure      | Focuses on solving a problem  |
| Can be implemented differently | Usually follows defined steps |
| Example: Factory               | Example: Binary Search        |

**Easy way to remember:**

```text
⚙️ Algorithm → HOW to solve a problem

🧩 Pattern   → HOW to organize code
```

---

## 🧱 What Does a Pattern Contain?

Every pattern in this repository will follow a simple structure:

```text
🎯 Intent
   ↓
❓ Problem
   ↓
💡 Solution
   ↓
🏗️ Structure
   ↓
💻 PHP Example
   ↓
✅ Pros & ❌ Cons
   ↓
🍽️ Real-world Example
```

---

# 🗂️ Types of Design Patterns

## 🏭 Creational Patterns

> Focus: **Object Creation**

```text
🏭 Creating Objects
       ↓
┌──────┼──────┐
Factory Builder Singleton
```

* Factory Method
* Abstract Factory
* Builder
* Prototype
* Singleton

🍽️ **POS Example:** Payment creation

---

## 🧱 Structural Patterns

> Focus: **Object & Class Structure**

```text
Object + Object
      ↓
   🧱 Structure
      ↓
 Larger System
```

* Adapter
* Bridge
* Composite
* Decorator
* Facade
* Flyweight
* Proxy

🍽️ **POS Example:** Payment gateway integration

---

## 🔄 Behavioral Patterns

> Focus: **Communication & Responsibility**

```text
👨‍🍳 Object
   ↕
🔄 Communication
   ↕
👨‍💼 Object
```

* Chain of Responsibility
* Command
* Iterator
* Mediator
* Observer
* State
* Strategy
* Template Method
* Visitor

🍽️ **POS Example:** Order status and notifications

---

# 🍽️ Restaurant POS Examples

This repository uses a **Restaurant POS** as a practical reference.

| 🧩 Pattern        | 🍽️ POS Use Case         |
| ----------------- | ------------------------ |
| 🏭 Factory Method | Payment creation         |
| 🎯 Strategy       | Discount calculation     |
| 👀 Observer       | Order notifications      |
| 📦 Command        | Order actions            |
| 🔌 Adapter        | Payment gateway          |
| 🎨 Decorator      | Add-ons / extra features |
| 🏢 Facade         | Checkout process         |

---

# 📚 Learning Roadmap

```text
                 🧩 DESIGN PATTERNS
                        │
          ┌─────────────┼─────────────┐
          ↓             ↓             ↓
       🏭 CREATIONAL  🧱 STRUCTURAL  🔄 BEHAVIORAL
          │             │             │
          ↓             ↓             ↓
       Factory       Adapter       Strategy
       Builder       Decorator     Observer
       Singleton     Facade        Command
          │             │             │
          └─────────────┼─────────────┘
                        ↓
                  🍽️ RESTAURANT POS
```

### ⭐ Recommended Learning Order

```text
1️⃣ Factory Method
        ↓
2️⃣ Strategy
        ↓
3️⃣ Observer
        ↓
4️⃣ Adapter
        ↓
5️⃣ Decorator
        ↓
6️⃣ Command
        ↓
7️⃣ Facade
        ↓
8️⃣ Abstract Factory
        ↓
9️⃣ Builder
        ↓
🔟 Other Patterns
```

---

# 📁 Project Structure

```text
design-patterns-php/
│
├── 📄 README.md
│
├── 🏭 creational/
│   ├── factory-method/
│   ├── abstract-factory/
│   ├── builder/
│   ├── prototype/
│   └── singleton/
│
├── 🧱 structural/
│   ├── adapter/
│   ├── bridge/
│   ├── composite/
│   ├── decorator/
│   ├── facade/
│   ├── flyweight/
│   └── proxy/
│
└── 🔄 behavioral/
    ├── chain-of-responsibility/
    ├── command/
    ├── iterator/
    ├── mediator/
    ├── observer/
    ├── state/
    ├── strategy/
    ├── template-method/
    └── visitor/
```

---

# 🎯 Learning Goal

> **Don't memorize patterns. Understand the problem first.**

```text
❌ "I need to use a pattern."

             ↓

✅ "I have a problem."

             ↓

🔍 "What causes this problem?"

             ↓

💡 "Can a design pattern help?"

             ↓

🧩 Apply the pattern
```

---

## 🚀 Let's Build Better Software

**Learn → Understand → Practice → Apply**

```text
        🧠
     Understand
        ↓
        💻
       Code
        ↓
        🍽️
   Real-world POS
        ↓
        🚀
 Better Architecture
```

---

### ⭐ If this repository helps you

Give it a ⭐ and keep learning!

**Made for learning PHP Design Patterns with real-world examples.**
