<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../config/database.php';

$db = Database::getConnection();

try {
    echo "Adding stock_quantity to products...\n";
    $db->exec("ALTER TABLE products ADD COLUMN stock_quantity INTEGER DEFAULT 0");
} catch (Exception $e) {
    echo "Column stock_quantity might already exist. Ignored.\n";
}

try {
    echo "Adding min_stock_level to products...\n";
    $db->exec("ALTER TABLE products ADD COLUMN min_stock_level INTEGER DEFAULT 5");
} catch (Exception $e) {
    echo "Column min_stock_level might already exist. Ignored.\n";
}

echo "Creating stock_movements table...\n";
$db->exec("
CREATE TABLE IF NOT EXISTS stock_movements (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    product_id INTEGER NOT NULL,
    type TEXT NOT NULL CHECK (type IN ('in', 'out')),
    quantity INTEGER NOT NULL,
    reason TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE
);
");

echo "Stock migration completed.\n";
