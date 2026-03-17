<?php
require_once __DIR__ . '/core/Database.php';

$tables = ['services', 'products', 'customers', 'professionals'];

try {
    $db = Database::getConnection();
    foreach ($tables as $table) {
        echo "--- SCHEMA: {$table} ---\n";
        $stmt = $db->query("PRAGMA table_info({$table})");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            printf("%-15s | %-10s | %-5s\n", $row['name'], $row['type'], $row['notnull'] ? 'NOT NULL' : 'NULL');
        }
        echo "\n";
    }
} catch (Exception $e) {
    echo "ERRO: " . $e->getMessage() . "\n";
}
