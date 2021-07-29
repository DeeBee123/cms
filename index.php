<?php
$request = $_SERVER['REQUEST_URI'];
$root = '/cms';

switch ($request) {
    case $root . '/':
        require __DIR__ . '/src/views/home.php';
        break;
    case $root . '':
        require __DIR__ . '/src/views/home.php';
        break;
    case $root . '/?p=' . $_GET['p']:
        require __DIR__ . '/src/views/home.php';
        break;
    case $root . '/admin':
        require __DIR__ . '/src/views/admin.php';
        break;
    case $root . '/admin' . '/newpage':
        require __DIR__ . '/src/views/admin.php';
        break;
    case $root . '/admin' . '?edit=' . $_GET['edit']:
        require __DIR__ . '/src/views/admin.php';
        break;

    case $root . '/admin' . '?delete=' . $_GET['delete']:
        require __DIR__ . '/src/views/admin.php';
        break;

    case $root . '/admin' . '?action=' . $_GET['action']:
        require __DIR__ . '/src/views/admin.php';
        break;
    case $root . '/login':
        require __DIR__ . '/src/views/login.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/src/views/404.html';
        break;
}
