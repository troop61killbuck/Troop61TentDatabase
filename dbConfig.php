<?php
// Database configuration
$dbHost     = "remotemysql.com";
$dbUsername = "TgaNN6RhpP";
$dbPassword = "LPOX4BuNJF";
$dbName     = "TgaNN6RhpP";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>