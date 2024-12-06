<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myproject_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $manufacturers = $_POST['manufacturers'];
    $serialNumber = $_POST['serialNumber'];
    $modelNumber = $_POST['modelNumber'];
    $type = $_POST['type'];
    $guarantee = $_POST['guarantee'];
    $dateOfPurchase = $_POST['dateOfPurchase'];
    $amount = $_POST['amount'];

    // Insert data into database
    $sql = "INSERT INTO equipment (name, manufacturers, serialNumber, modelNumber, type, guarantee, dateOfPurchase, amount) 
            VALUES ('$name', '$manufacturers', '$serialNumber', '$modelNumber', '$type', '$guarantee', '$dateOfPurchase', '$amount')";

if ($conn->query($sql) === TRUE) {
    // Show alert and redirect to components-alerts.html
    echo "<script>
        alert('New equipment added successfully!');
        window.location.href = 'Eqiupment.php';
        </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

    $conn->close();
}
?>
