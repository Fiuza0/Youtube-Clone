<?php
/* 
session_start();
Authentication check (optional)
if (!isset($_SESSION['user'])) {
    die("Unauthorized");
}
*/

// Validate and sanitize the file parameter
$file = isset($_GET['file']) ? basename($_GET['file']) : null;
$videoPath = 'Services/videos' . $file;

// Check if the file exists
if (!$file || !file_exists($videoPath)) {
    die("File not found.");
}

// Set MIME type based on file extension
$mimeTypes = [
    'mp4' => 'video/mp4',
    'webm' => 'video/webm',
    'ogg' => 'video/ogg'
];
$ext = strtolower(pathinfo($videoPath, PATHINFO_EXTENSION));
header("Content-Type: " . ($mimeTypes[$ext] ?? 'application/octet-stream'));

// Handle partial content (for seeking)
$size = filesize($videoPath);
$start = 0;
$end = $size - 1;

if (isset($_SERVER['HTTP_RANGE'])) {
    preg_match('/bytes=(\d+)-(\d+)?/', $_SERVER['HTTP_RANGE'], $matches);
    $start = intval($matches[1]);
    $end = $matches[2] ? intval($matches[2]) : $size - 1;
    header("HTTP/1.1 206 Partial Content");
    header("Content-Range: bytes $start-$end/$size");
}

header("Accept-Ranges: bytes");
header("Content-Length: " . ($end - $start + 1));

// Output the video chunk
$handle = fopen($videoPath, 'rb');
fseek($handle, $start);
$buffer = 1024 * 8;
while (!feof($handle) && ($pos = ftell($handle)) <= $end) {
    echo fread($handle, min($buffer, $end - $pos + 1));
    flush();
}
fclose($handle);
exit;
?>