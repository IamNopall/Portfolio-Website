<?php

// Prepare writable paths in /tmp for Vercel Serverless environment
$storageDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache'
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

// Copy sqlite database to /tmp if using local sqlite on serverless
$sourceSqlite = __DIR__ . '/../database/database.sqlite';
$targetSqlite = '/tmp/database.sqlite';
if (file_exists($sourceSqlite) && !file_exists($targetSqlite)) {
    @copy($sourceSqlite, $targetSqlite);
}

// Forward execution to Laravel's public entrypoint
require __DIR__ . '/../public/index.php';
