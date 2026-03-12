<?php

class ImageHandler {
    private static $uploadDir = __DIR__ . '/../public/uploads/';

    /**
     * Handles image upload or returns the URL if provided.
     * 
     * @param array $file The $_FILES element
     * @param string $url The manual URL input
     * @param string|null $existingPath Current path/URL to retain if no new data provided
     * @return string|null The resulting path or URL
     */
    public static function handle($file, $url = null, $existingPath = null) {
        // 1. Handle File Upload (Priority)
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $tmpPath = $file['tmp_name'];
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $fileName = uniqid('img_', true) . '.' . $extension;
            $destination = self::$uploadDir . $fileName;

            // Validate mime type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/x-icon'];
            $fileInfo = getimagesize($tmpPath);
            
            // Special check for .ico if getimagesize fails
            if ($extension === 'ico' || ($fileInfo && in_array($fileInfo['mime'], $allowedTypes))) {
                if (move_uploaded_file($tmpPath, $destination)) {
                    return '/uploads/' . $fileName;
                }
            }
        }

        // 2. If no file upload, then check for URL provided manually
        if (!empty($url)) {
            return $url;
        }

        // 3. Return existing if no new data provided
        return $existingPath;
    }
}
