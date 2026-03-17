<?php
require_once __DIR__ . '/core/Database.php';

try {
    $db = Database::getConnection();
    
    echo "--- ÚLTIMAS 5 VENDAS ---\n";
    $stmt = $db->query("SELECT * FROM sales ORDER BY id DESC LIMIT 5");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: {$row['id']} | Total: {$row['total_amount']} | Date: {$row['created_at']}\n";
    }
    
    echo "\n--- ÚLTIMAS 5 COMISSÕES ---\n";
    $stmt = $db->query("SELECT * FROM commissions ORDER BY id DESC LIMIT 5");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: {$row['id']} | SaleItem: {$row['sale_item_id']} | Amt: {$row['amount']} | Date: {$row['created_at']}\n";
    }

    echo "\n--- ÚLTIMAS 5 TRANSAÇÕES FINANCEIRAS ---\n";
    $stmt = $db->query("SELECT * FROM financial_transactions ORDER BY id DESC LIMIT 5");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: {$row['id']} | Desc: {$row['description']} | Amt: {$row['amount']} | Ref: {$row['reference_type']} #{$row['reference_id']}\n";
    }

} catch (Exception $e) {
    echo "ERRO: " . $e->getMessage() . "\n";
}
