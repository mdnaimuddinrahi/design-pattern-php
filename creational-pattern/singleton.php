<?php
/***
 * **Singleton** is a creational design pattern that lets you ensure that
    a class has only one instance, while providing a global access point
    to this instance.
 * Problem
    The Singelon pattern solves two problems at the same time, violating
    the Single Responsibility Principle:
    1. Ensure that a class has just a single instance.
    2. Provide a global acess point to that instance.
 * Pros:
    * You can be sure that a class has only a single instance.
    * You gain a global access point to that instance.
    * The singleton object is initialized only when it's requested for
      the first time. 
 * Cons:
    * Violates the Single Responsibility Principle. The pattern solves 
      two problems at the time.
    * The Singleton pattern can mask bad design, for instance, when
      the components of the program know too much about each other.
    * The pattern requires special treatment in a multithreaded
      environment so that multiple threads won't create a singleton
      object several times.
    * It may be difficult to unit test the client code of the singleton
      because many test frameworks rely on inheritance when producing mock
      objects. Since the constructor of the singleton class is private and
      overriding static methods is impossible in most languages, you will 
      need to think of a creative way to mock the singleton.
      Or just don't write the tests. Or don't use the Singleton pattern.
      
 */

class Database
{
  private static ?Database $instance = null;

  private function __construct()
  {
    echo "Database instance created.\n";
  }

  private function __clone() {}

  public function __wakeup(): void
  {
    throw new LogicException("Can not userialize a singleton");
  }

  public static function getInstance()
  {
    if(self::$instance === null) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  public function connect(): void
  {
    echo "Connected to the database.\n";
  }
}


// Get the singleton instance
$db1 = Database::getInstance();
$db2 = Database::getInstance();

// Use the instance
$db1->connect();

// Verify both variables reference the same object 
var_dump($db1 === $db2);

/**
 * Output
 * 
 * Database instance created.
 * Connected to the database.
 * bool(true)
 */