<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cupom de Venda #<?= $sale['id'] ?></title>
    <style>
        @page { size: 80mm 200mm; margin: 0; }
        body { 
            font-family: 'Courier New', Courier, monospace; 
            font-size: 12px; 
            width: 72mm; 
            margin: 0 auto; 
            padding: 10px;
            color: #000;
        }
        .header { text-align: center; margin-bottom: 10px; }
        .salon-name { font-size: 16px; font-weight: bold; text-transform: uppercase; }
        .divider { border-top: 1px dashed #000; margin: 5px 0; }
        .items { width: 100%; border-collapse: collapse; }
        .items td { padding: 2px 0; }
        .text-right { text-align: right; }
        .total-row { font-weight: bold; font-size: 14px; }
        .footer { text-align: center; margin-top: 15px; font-size: 10px; }
        .no-print { 
            margin-top: 20px; 
            text-align: center; 
            background: #eee; 
            padding: 10px;
            border-radius: 5px;
        }
        @media print {
            .no-print { display: none; }
        }
        .btn-print {
            background: #000;
            color: #fff;
            padding: 5px 15px;
            text-decoration: none;
            font-family: sans-serif;
            font-size: 12px;
            border-radius: 3px;
            display: inline-block;
        }
    </style>
</head>
<body onload="<?= isset($_GET['print']) ? 'window.print()' : '' ?>">

    <div class="header">
        <div class="salon-name"><?= htmlspecialchars($global['title'] ?? 'SALON MANAGER') ?></div>
        <div><?= htmlspecialchars($global['subtitle'] ?? 'Seu Salão, Sua Beleza') ?></div>
        <div class="divider"></div>
        <div>CUPOM NÃO FISCAL</div>
        <div>VENDA #<?= $sale['id'] ?></div>
        <div><?= date('d/m/Y H:i', strtotime($sale['created_at'])) ?></div>
    </div>

    <div class="divider"></div>

    <div>CLIENTE: <?= htmlspecialchars($sale['customer_name']) ?></div>
    <?php if ($sale['customer_phone']): ?>
        <div>TEL: <?= htmlspecialchars($sale['customer_phone']) ?></div>
    <?php endif; ?>

    <div class="divider"></div>

    <table class="items">
        <thead>
            <tr>
                <th align="left">ITEM</th>
                <th align="center">QT</th>
                <th align="right">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars(mb_substr($item['item_name'], 0, 15)) ?></td>
                <td align="center"><?= $item['quantity'] ?></td>
                <td align="right"><?= number_format($item['subtotal'], 2, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="divider"></div>

    <table class="items">
        <tr class="total-row">
            <td>TOTAL</td>
            <td align="right">R$ <?= number_format($sale['total_amount'], 2, ',', '.') ?></td>
        </tr>
        <tr>
            <td>PAGAMENTO</td>
            <td align="right"><?= strtoupper($sale['payment_method']) ?></td>
        </tr>
    </table>

    <div class="divider"></div>

    <div class="footer">
        Obrigado pela preferência!<br>
        Volte sempre.<br>
        <?= date('d/m/Y H:i:s') ?>
    </div>

    <div class="no-print">
        <a href="javascript:window.print()" class="btn-print">Imprimir Cupom</a>
        <br><br>
        <small>Pressione Esc para fechar</small>
    </div>

</body>
</html>
