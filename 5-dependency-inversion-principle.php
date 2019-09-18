<?php

/**
 * Dependency Inversion Principle
 *
 * Entities must depend on abstractions not on concretions.
 * The high level module must not depend on the low level module, but they both should depend on abstractions.
 */

class MySQLConnection implements DBConnectionInterface {
    public function connect() {
        // TODO: Implement connect() method.
    }
}

class BadPasswordReminder {
    private $dbConnection;

    public function __construct(MySQLConnection $dbConnection) {
        $this->dbConnection = $dbConnection;
    }
}

/**
 * DIP is violated.
 *
 * Let's fix it!
 */

interface DBConnectionInterface {
    public function connect();
}

class PasswordReminder {
    private $dbConnection;

    public function __construct(DBConnectionInterface $dbConnection) {
        $this->dbConnection = $dbConnection;
    }
}

