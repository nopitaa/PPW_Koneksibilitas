<?php
$path = __DIR__ . '/../public/storage';
if (file_exists($path)) {
    echo 'exists\n';
    echo 'is_link: ' . (is_link($path) ? 'yes' : 'no') . "\n";
    echo 'realpath: ' . (realpath($path) ?: 'NULL') . "\n";
    // lstat not easily portable on Windows; show file type
    $info = stat($path);
    var_export($info ?: 'no_stat');
    echo "\n";
} else {
    echo 'missing\n';
}
