<?php
// Get size param, default 10MB if invalid or missing
$default_size = 10 * 1024 * 1024; // 10 MB
$max_size = 5 * 1024 * 1024 * 1024; // 5 GB

$size = isset($_GET['size']) ? (int)$_GET['size'] : $default_size;
if ($size <= 0 || $size > $max_size) {
    $size = $default_size;
}

// 64 KB chunk size
$chunk = str_repeat('A', 64 * 1024);
$chunks = intdiv($size, strlen($chunk));
$remainder = $size % strlen($chunk);

header('Content-Type: application/octet-stream');
header("Content-Length: $size");
header('Cache-Control: no-store');

for ($i = 0; $i < $chunks; $i++) {
    echo $chunk;
    flush();
    // usleep(1000); // optional delay if needed
}

// Output remainder bytes
if ($remainder > 0) {
    echo str_repeat('A', $remainder);
    flush();
}

?>
