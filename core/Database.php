<?php

class Database {
    private static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            $config = require __DIR__ . '/../config/database.php';
            try {
                self::$connection = new PDO("sqlite:" . $config['database']);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                
                // Enable foreign keys for SQLite
                self::$connection->exec('PRAGMA foreign_keys = ON;');
            } catch (PDOException $e) {
                die("Database Connection Error: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
