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

// ✅ Create table if it does not exist
$tableName = "tasks";
$sql = "CREATE TABLE IF NOT EXISTS $tableName (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
//    echo "Table '$tableName' is ready!";
} else {
//    echo "Error creating table: " . $conn->error;
}

// Close the connection
//$conn->close();
?>
