<?php
$dbFile = __DIR__ . '/database.sqlite';
if (file_exists($dbFile)) {
    unlink($dbFile);
}

require_once __DIR__ . '/../core/Database.php';
$db = Database::getConnection();

$schema = file_get_contents(__DIR__ . '/schema.sql');
$db->exec($schema);

$seed = file_get_contents(__DIR__ . '/seed.sql');
$db->exec($seed);

// Hash the passwords
$passwordAdmin = password_hash('admin123', PASSWORD_BCRYPT);
$db->exec("UPDATE users SET password = '{$passwordAdmin}' WHERE role = 'admin'");

$passwordUser = password_hash('password', PASSWORD_BCRYPT);
$db->exec("UPDATE users SET password = '{$passwordUser}' WHERE role != 'admin'");

echo "Database migrated and seeded successfully.\n";
