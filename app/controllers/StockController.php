<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/StockMovement.php';

class StockController extends Controller {
    
    public function __construct() {
        Auth::requireLogin();
    }

    public function index() {
        $productModel = new Product();
        $products = $productModel->all();

        $this->view('layouts/admin', [
            'title' => 'Controle de Estoque | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/stock/index', compact('products'))
        ]);
    }

    public function movementForm() {
        $id = $_GET['product_id'] ?? null;
        if (!$id) {
            $this->redirect('/admin/stock');
            return;
        }

        $productModel = new Product();
        $product = $productModel->find($id);

        if (!$product) {
            $this->redirect('/admin/stock');
            return;
        }

        $this->view('layouts/admin', [
            'title' => 'Movimentar Estoque | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/stock/movement', compact('product'))
        ]);
    }

    public function storeMovement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            
            $productId = $data['product_id'];
            $type = $data['type']; // 'in' or 'out'
            $quantity = (int)$data['quantity'];
            $reason = $data['reason'];

            if ($quantity <= 0) {
                // simple validation
                $this->redirect('/admin/stock');
                return;
            }

            $db = Database::getConnection();
            $db->beginTransaction();

            try {
                // Insert movement
                $movementModel = new StockMovement();
                $movementModel->create([
                    'product_id' => $productId,
                    'type' => $type,
                    'quantity' => $quantity,
                    'reason' => $reason
                ]);

                // Update product stock
                $productModel = new Product();
                $product = $productModel->find($productId);
                
                $newStock = (int)$product['stock_quantity'];
                if ($type === 'in') {
                    $newStock += $quantity;
                } else {
                    $newStock -= $quantity;
                }

                if ($newStock < 0) {
                    $newStock = 0; // Prevent negative stock for simplicity, or could throw error
                }

                $productModel->update($productId, ['stock_quantity' => $newStock]);

                $db->commit();
            } catch (Exception $e) {
                $db->rollBack();
            }

            $this->redirect('/admin/stock');
        }
    }

    public function history() {
        $id = $_GET['product_id'] ?? null;
        if (!$id) {
            $this->redirect('/admin/stock');
            return;
        }

        $productModel = new Product();
        $product = $productModel->find($id);

        ob_start();
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM stock_movements WHERE product_id = ? ORDER BY created_at DESC");
        $stmt->execute([$id]);
        $movements = $stmt->fetchAll();

        $this->view('layouts/admin', [
            'title' => 'Histórico de Estoque | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/stock/history', compact('product', 'movements'))
        ]);
    }
    
    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}
