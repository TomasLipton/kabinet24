<?php
// Router for the local PHP development server; production uses .htaccess/nginx.
$root = dirname(__DIR__);
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (preg_match('#^/(?:lib|templates|scripts|styles|tests|node_modules)(?:/|$)#', rawurldecode($path ?: '/'))) {
    http_response_code(403);
    exit('Forbidden');
}
$file = realpath($root . rawurldecode($path ?: '/'));
if ($file && str_starts_with($file, $root . DIRECTORY_SEPARATOR) && is_file($file)) {
    return false;
}
require $root . '/index.php';
