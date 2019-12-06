<?php
// Database configuration
$dbHost     = "host"; 				// Set database host where it says 'host'
$dbUsername = "username";			// Set database user where it says 'username'
$dbPassword = "password";			// Set database password where it says 'password'
$dbName     = "databasename";		// Set database name where it says 'databasename'

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>