<?php
// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'qwer1234';
$db_name = 'your_database_name';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    $error = array("message" => "Connection failed: " . $conn->connect_error);
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode($error);
    exit;
}

// Check if form fields are not empty
if (
    empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['message'])
) {
    $error = array("message" => "All form fields are required.");
    header('Content-Type: application/json');
    http_response_code(400); // Bad Request
    echo json_encode($error);
    exit;
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$optin = isset($_POST['optin']) ? $_POST['optin'] : '';

// Insert data into the database
$sql = "INSERT INTO your_table_name (name, email, message, optin) VALUES ('$name', '$email', '$message', '$optin')";

if ($conn->query($sql) === TRUE) {
    echo "Data stored successfully";
} else {
    $error = array("message" => "Error storing data: " . $conn->error);
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode($error);
}

// Close the database connection
$conn->close();
?>
