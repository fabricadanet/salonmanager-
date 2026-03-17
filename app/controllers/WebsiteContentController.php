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
            require_once __DIR__ . '/../../core/ImageHandler.php';
            $model = new WebsiteContent();
            
            // Loop through posted sections
            foreach ($_POST as $section => $fields) {
                if (is_array($fields)) {
                    $existing = $model->where('section', $section)[0] ?? null;
                    
                    // Handle image upload/URL
                    $fileInput = null;
                    if (isset($_FILES[$section]['name']['image']) && !empty($_FILES[$section]['name']['image'])) {
                        $fileInput = [
                            'name' => $_FILES[$section]['name']['image'],
                            'type' => $_FILES[$section]['type']['image'],
                            'tmp_name' => $_FILES[$section]['tmp_name']['image'],
                            'error' => $_FILES[$section]['error']['image'],
                            'size' => $_FILES[$section]['size']['image']
                        ];
                    }

                    $imagePath = ImageHandler::handle(
                        $fileInput, 
                        $fields['image_url'] ?? null, 
                        $existing['image'] ?? ''
                    );

                    // Map fields based on what's available in the $fields array
                    $updateData = [
                        'image' => $imagePath,
                        'section' => $section
                    ];

                    // Title mapping - Sanitize as plain text
                    if (isset($fields['title'])) {
                        $updateData['title'] = Validator::sanitize($fields['title']);
                    } elseif ($existing) {
                        $updateData['title'] = $existing['title'];
                    }

                    // Subtitle mapping - Sanitize as plain text
                    if (isset($fields['subtitle'])) {
                        $updateData['subtitle'] = Validator::sanitize($fields['subtitle']);
                    } elseif ($existing) {
                        $updateData['subtitle'] = $existing['subtitle'];
                    }

                    // Content field mapping - DO NOT sanitize rich text HTML content 
                    // Validator::sanitize uses htmlspecialchars which doubles-escapes tags from Quill.js
                    if (isset($fields['content'])) {
                        // Allow HTML but keep raw for Database
                        $updateData['content'] = $fields['content']; 
                    } elseif (isset($fields['footer_text'])) {
                        // Footer text is also often HTML / rich
                        $updateData['content'] = $fields['footer_text'];
                    } elseif ($existing) {
                        $updateData['content'] = $existing['content'];
                    }

                    if ($existing) {
                        $model->update($existing['id'], $updateData);
                    } else {
                        $updateData['section'] = $section;
                        $model->create($updateData);
                    }
                }
            }
            $this->redirect('/admin/content');
        }
    }
    
    public function seo() {
        $model = new WebsiteContent();
        $seo = $model->where('section', 'seo')[0] ?? [];
        
        // Decode fields if stored in 'content' as JSON or handled separately
        // For simplicity, we'll store specific scripts in title/subtitle/content fields
        // title -> Google Tag
        // content -> Other Header Scripts
        
        $this->view('layouts/admin', [
            'title' => 'SEO & Rastreamento | SalonManager',
            'showSidebar' => true,
            'seo' => $seo,
            'content' => $this->renderPartial('admin/seo/index', compact('seo'))
        ]);
    }

    public function updateSeo() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST; // Don't use Validator::sanitize for scripts as it might strip tags
            $model = new WebsiteContent();
            
            $existing = $model->where('section', 'seo')[0] ?? null;
            
            $updateData = [
                'title' => $data['google_tag'] ?? '',
                'content' => $data['header_scripts'] ?? '',
                'section' => 'seo'
            ];

            if ($existing) {
                $model->update($existing['id'], $updateData);
            } else {
                $model->create($updateData);
            }
            
            $this->redirect('/admin/seo?success=1');
        }
    }
    
    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}
