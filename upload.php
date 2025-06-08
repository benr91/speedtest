<?php
// upload.php
// Accept POST upload and discard data without storing

// Limit max upload size to 5GB (optional)
$max_size = 5 * 1024 * 1024 * 1024;

$input = fopen("php://input", "rb");
$bytesRead = 0;

while (!feof($input)) {
    $buffer = fread($input, 8192);
    if ($buffer === false) break;
    $bytesRead += strlen($buffer);
    if ($bytesRead > $max_size) {
        // Optionally stop reading if exceeds limit
        break;
    }
}

fclose($input);

http_response_code(200);
echo "OK"
?>
