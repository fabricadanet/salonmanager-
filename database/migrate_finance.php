<?php

require_once __DIR__ . '/../core/Database.php';

$db = Database::getConnection();

echo "Iniciando migração do Módulo Financeiro...\n";

try {
    $db->beginTransaction();

    // Tabela: Categorias Financeiras
    $db->exec("
        CREATE TABLE IF NOT EXISTS financial_categories (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(100) NOT NULL,
            type VARCHAR(20) NOT NULL, -- 'income' ou 'expense'
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Inserir categorias padrões se não existem
    $stmt = $db->query("SELECT COUNT(*) FROM financial_categories");
    if ($stmt->fetchColumn() == 0) {
        $db->exec("
            INSERT INTO financial_categories (name, type) VALUES 
            ('Venda PDV', 'income'),
            ('Agendamento', 'income'),
            ('Aluguel', 'expense'),
            ('Comissão Profissional', 'expense'),
            ('Insumos e Produtos', 'expense'),
            ('Conta de Energia', 'expense'),
            ('Conta de Água', 'expense'),
            ('Marketing', 'expense'),
            ('Outras Receitas', 'income'),
            ('Outras Despesas', 'expense')
        ");
    }

    // Tabela: Transações Financeiras (Contas a Pagar / Receber)
    $db->exec("
        CREATE TABLE IF NOT EXISTS financial_transactions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            category_id INTEGER NOT NULL,
            description VARCHAR(255) NOT NULL,
            type VARCHAR(20) NOT NULL, -- 'income' ou 'expense'
            amount REAL NOT NULL,
            due_date DATE NOT NULL,
            payment_date DATE NULL,
            status VARCHAR(20) DEFAULT 'pending', -- 'pending' ou 'paid'
            reference_id INTEGER NULL,
            reference_type VARCHAR(50) NULL, -- 'commission', 'sale', 'appointment'
            is_recurring BOOLEAN DEFAULT 0,
            recurrence_period VARCHAR(20) NULL, -- 'monthly', 'yearly'
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES financial_categories(id)
        )
    ");

    $db->commit();
    echo "Migração do Módulo Financeiro finalizada com sucesso!\n";

} catch (Exception $e) {
    if ($db->inTransaction()) {
        $db->rollBack();
    }
    echo "Erro durante a migração: " . $e->getMessage() . "\n";
}
