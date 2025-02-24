<?php
// Fetch the JSON string from environment variable
$credentialsJson = getenv('DB_CREDENTIALS');

// Decode JSON into an associative array
$credentials = json_decode($credentialsJson, true);

// Extract individual values
$servername = getenv('DB_HOST');  // Assuming DB_HOST is set separately
$username = $credentials['username'] ?? '';
$password = $credentials['password'] ?? '';
$dbname = $credentials['db_name'] ?? '';

// Establish Database Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully!";
?>
