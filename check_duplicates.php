<?php
require_once __DIR__ . '/core/Database.php';

try {
    $db = Database::getConnection();
    
    echo "--- ÚLTIMAS 20 COMISSÕES ---\n";
    $stmt = $db->query("SELECT * FROM commissions ORDER BY id DESC LIMIT 20");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        printf("ID: %d | App: %s | Prof: %d | Amt: %.2f | Date: %s | SaleItem: %s\n", 
            $row['id'], $row['appointment_id'] ?? 'NULL', $row['professional_id'], $row['amount'], $row['created_at'], $row['sale_item_id'] ?? 'NULL');
    }
    
    echo "\n--- ÚLTIMAS 20 TRANSAÇÕES FINANCEIRAS ---\n";
    $stmt = $db->query("SELECT * FROM financial_transactions ORDER BY id DESC LIMIT 20");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        printf("ID: %d | Desc: %-40s | Amt: %.2f | Type: %s | Ref: %s #%s | Created: %s\n", 
            $row['id'], substr($row['description'], 0, 40), $row['amount'], $row['type'], $row['reference_type'], $row['reference_id'], $row['created_at']);
    }

    echo "\n--- POSSÍVEIS DUPLICATAS (Comissões com mesmo SaleItem e Profissional) ---\n";
    $stmt = $db->query("SELECT sale_item_id, professional_id, COUNT(*) as qty FROM commissions WHERE sale_item_id IS NOT NULL GROUP BY sale_item_id, professional_id HAVING qty > 1");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "SaleItem #{$row['sale_item_id']} | Prof #{$row['professional_id']} | Qty: {$row['qty']}\n";
    }

} catch (Exception $e) {
    echo "ERRO: " . $e->getMessage() . "\n";
}
