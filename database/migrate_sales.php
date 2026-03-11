<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../config/database.php';

$db = Database::getConnection();

try {
    echo "Adding commission_percentage to products...\n";
    $db->exec("ALTER TABLE products ADD COLUMN commission_percentage REAL DEFAULT 0.0");
} catch (Exception $e) {
    echo "Column commission_percentage might already exist. Ignored.\n";
}

echo "Creating sales table...\n";
$db->exec("
CREATE TABLE IF NOT EXISTS sales (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    customer_id INTEGER NULL,
    total_amount REAL NOT NULL,
    payment_method TEXT CHECK(payment_method IN ('dinheiro', 'pix', 'cartao credito', 'cartao debito')),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(customer_id) REFERENCES customers(id) ON DELETE SET NULL
);
");

echo "Creating sale_items table...\n";
$db->exec("
CREATE TABLE IF NOT EXISTS sale_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    sale_id INTEGER NOT NULL,
    type TEXT NOT NULL CHECK(type IN ('product', 'service')),
    item_id INTEGER NOT NULL,
    professional_id INTEGER NULL,
    quantity INTEGER NOT NULL DEFAULT 1,
    unit_price REAL NOT NULL,
    subtotal REAL NOT NULL,
    FOREIGN KEY(sale_id) REFERENCES sales(id) ON DELETE CASCADE,
    FOREIGN KEY(professional_id) REFERENCES professionals(id) ON DELETE SET NULL
);
");

echo "Sales migration completed.\n";
