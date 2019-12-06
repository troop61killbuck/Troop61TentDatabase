<?php
// Database configuration
$dbHost     = "sql101.byethost.com"; 				// Set database host where it says 'host'
$dbUsername = "b18_24837584";			// Set database user where it says 'username'
$dbPassword = "Pikes14,110";			// Set database password where it says 'password'
$dbName     = "b18_24837584_Troop61TentDatabase";		// Set database name where it says 'databasename'

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>