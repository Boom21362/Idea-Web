<?php

// Ensure the SQLite database file exists
$databasePath = '/tmp/database.sqlite';
if (!file_exists($databasePath)) {
    touch($databasePath);
}

// Register environment variables
putenv("DB_CONNECTION=sqlite");
putenv("DB_DATABASE={$databasePath}");
putenv("VIEW_COMPILED_PATH=/tmp");

// 3. Forward the request
require __DIR__ . '/../public/index.php';