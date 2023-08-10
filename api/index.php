<?php
const PAGE_DEFAULT = 1;
const OFFSET_DEFAULT = 5;

$objects = json_decode(file_get_contents('objects.json'));

$page = $_GET['page'] ?? PAGE_DEFAULT;
$offset = $_GET['offset'] ?? OFFSET_DEFAULT;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if (!is_numeric($page) || !is_numeric($offset) || $page < 1 || $offset < 1) {
    header('Status: 400');
    return;
}

$chunks = array_chunk($objects, $offset);
$currentChunk = $chunks[$page - 1] ?? [];

echo json_encode($currentChunk);
return;
