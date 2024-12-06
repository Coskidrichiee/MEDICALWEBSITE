<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "sql207.infinityfree.com";
$username = "if0_37494481";
$password = "AtKGrLD0r1Y";
$dbname = "if0_37494481_myproject_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data and escape strings for security
    $date = $conn->real_escape_string($_POST['date']);
    $equipmentName = $conn->real_escape_string($_POST['equipmentName']);
    $manufacturer = $conn->real_escape_string($_POST['manufacturer']);
    $serialNumber = $conn->real_escape_string($_POST['serialNumber']);
    $modelNumber = $conn->real_escape_string($_POST['modelNumber']);
    $fault = $conn->real_escape_string($_POST['fault']);
    $troubleshooting = $conn->real_escape_string($_POST['troubleshooting']);
    $repair = $conn->real_escape_string($_POST['repair']);
    $engineer = $conn->real_escape_string($_POST['engineer']);

    // Prepare the SQL query with placeholders to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO work_orders (date, equipment_name, manufacturer, serial_number, model_number, fault, troubleshooting, repair, engineer) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sssssssss", $date, $equipmentName, $manufacturer, $serialNumber, $modelNumber, $fault, $troubleshooting, $repair, $engineer);

    // Execute the query
    if ($stmt->execute()) {
        echo "New work order added successfully!";
    } else {
        echo "Error in executing statement: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Form not submitted";
}

// Close connection
$conn->close();
?>
