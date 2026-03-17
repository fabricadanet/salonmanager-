<?php
require_once __DIR__ . '/core/Database.php';

$tables = ['services', 'products', 'customers', 'professionals'];

try {
    $db = Database::getConnection();
    foreach ($tables as $table) {
        echo "Updating table: {$table}... ";
        try {
            // SQLite doesn't support IF NOT EXISTS in ALTER TABLE for column addition in all versions, 
            // so we try and catch the specific error if it already exists.
            $db->exec("ALTER TABLE {$table} ADD COLUMN deleted_at DATETIME NULL");
            echo "SUCCESS\n";
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'duplicate column name') !== false) {
                echo "Column already exists, skipping.\n";
            } else {
                echo "ERROR: " . $e->getMessage() . "\n";
            }
        }
    }
    echo "Migration completed.\n";
} catch (Exception $e) {
    echo "CRITICAL ERROR: " . $e->getMessage() . "\n";
}
