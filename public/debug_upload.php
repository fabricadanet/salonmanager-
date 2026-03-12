<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    file_put_contents('debug_upload.txt', "POST Data:\n" . print_r($_POST, true) . "\nFILES Data:\n" . print_r($_FILES, true));
}
?>
