<?php
require __DIR__ . '/../vendor/autoload.php';

// simple sqlite read via PDO
$dbPath = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbPath)) {
    echo "NO_DB\n";
    exit;
}
try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $stmt = $pdo->query('SELECT id, avatar_path FROM profiles LIMIT 1');
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
} catch (Exception $e) {
    echo "PDO_ERROR:" . $e->getMessage() . "\n";
    exit;
}
if (! $row) {
    echo "NO_PROFILE\n";
    exit;
}
echo "id=" . ($row['id'] ?? '') . "\n";
echo "avatar_path=" . ($row['avatar_path'] ?? 'NULL') . "\n";

// check file on storage/app/public
$path = $row['avatar_path'] ?? null;
if (! $path) {
    echo "NO_FILE_PATH\n";
    exit;
}
$full = __DIR__ . '/../storage/app/public/' . $path;
if (file_exists($full)) {
    echo "FILE_EXISTS:" . realpath($full) . "\n";
} else {
    echo "FILE_MISSING:" . $full . "\n";
}

// check public/storage symlink
$publicLink = __DIR__ . '/../public/storage/' . $path;
if (file_exists($publicLink)) {
    echo "PUBLIC_LINK_EXISTS:" . realpath($publicLink) . "\n";
} else {
    echo "PUBLIC_LINK_MISSING:" . $publicLink . "\n";
}
