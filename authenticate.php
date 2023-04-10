<?php
// Retrieve user input
$username = $_POST['username'];
$password = $_POST['password'];

// Connect to RDS
$servername = "<your-rds-endpoint>";
$db_username = "<your-db-username>";
$db_password = "<your-db-password>";
$dbname = "<your-db-name>";
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    echo "Welcome " . $username . "!";
} else {
    echo "Invalid username or password.";
}

// Close connection
$stmt->close();
$conn->close();
?>