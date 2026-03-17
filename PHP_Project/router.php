<?php
// Built-in PHP server router
// This file routes all requests to index.php

// Get the requested file/path
$requested = $_SERVER['REQUEST_URI'];

// If the requested file/directory exists, serve it directly
if (file_exists(__DIR__ . $requested)) {
    return false; // Let PHP server handle static files
}

// Otherwise, route to index.php
require_once __DIR__ . '/index.php';
