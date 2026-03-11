<?php
require_once __DIR__ . '/../models/WebsiteContent.php';

class WebsiteContentController extends Controller {
    
    public function __construct() {
        Auth::requireLogin();
    }

    public function index() {
        $model = new WebsiteContent();
        $itemsRaw = $model->all();
        
        $content = [];
        foreach ($itemsRaw as $item) {
            $content[$item['section']] = $item;
        }

        $this->view('layouts/admin', [
            'title' => 'Site Público | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/content/index', compact('content'))
        ]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            $model = new WebsiteContent();
            
            // Loop through posted sections
            foreach ($data as $section => $fields) {
                if (is_array($fields)) {
                    // find id of section
                    $existing = $model->where('section', $section)[0] ?? null;
                    if ($existing) {
                        $model->update($existing['id'], [
                            'title' => $fields['title'] ?? '',
                            'subtitle' => $fields['subtitle'] ?? '',
                            'content' => $fields['content'] ?? '',
                            'image' => $fields['image'] ?? ''
                        ]);
                    } else {
                        // create
                        $model->create([
                            'section' => $section,
                            'title' => $fields['title'] ?? '',
                            'subtitle' => $fields['subtitle'] ?? '',
                            'content' => $fields['content'] ?? '',
                            'image' => $fields['image'] ?? ''
                        ]);
                    }
                }
            }
            $this->redirect('/admin/content');
        }
    }
    
    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}
