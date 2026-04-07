<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli(
        "localhost",
        "oneten",   // your user
        "japanstar2026330",          // your password
        "laravel_adminlte"      // your database
    );

    echo "✅ DB Connected Successfully!";

} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage();
}