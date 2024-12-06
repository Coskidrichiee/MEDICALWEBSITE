<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myproject_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create an associative array to hold form data
    $formData = [
        'fullName' => $_POST['fullName'],
        'about' => $_POST['about'],
        'company' => $_POST['company'],
        'job' => $_POST['job'],
        'country' => $_POST['country'],
        'address' => $_POST['address'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'twitter' => $_POST['twitter'],
        'facebook' => $_POST['facebook'],
        'instagram' => $_POST['instagram'],
        'linkedin' => $_POST['linkedin'],
        'userId' => 1 // Replace with actual user ID for the logged-in user
    ];

    // Initialize image variable
    $targetFile = null;

    // Handling file upload
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == UPLOAD_ERR_OK) {
        $targetDir = __DIR__ . "/uploads/"; // Using absolute path
        $targetFile = $targetDir . basename($_FILES["profileImage"]["name"]);

        // Check if the uploads directory exists, create it if not
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); // Create the directory with appropriate permissions
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {
            echo "Error uploading file.";
            exit();
        }
    }

    // Prepare and execute the SQL statement
    if ($targetFile !== null) {
        // Update statement with profile image
        $stmt = $conn->prepare("UPDATE profiles SET fullName=?, about=?, company=?, job=?, country=?, address=?, phone=?, email=?, twitter=?, facebook=?, instagram=?, linkedin=?, profileImage=? WHERE userId=?");
        
        // Bind parameters (13 parameters)
        $stmt->bind_param("ssssssssssssi", 
            $formData['fullName'], 
            $formData['about'], 
            $formData['company'], 
            $formData['job'], 
            $formData['country'], 
            $formData['address'], 
            $formData['phone'], 
            $formData['email'], 
            $formData['twitter'], 
            $formData['facebook'], 
            $formData['instagram'], 
            $formData['linkedin'], 
            $targetFile, 
            $formData['userId']
        );
    } else {
        // Update statement without profile image
        $stmt = $conn->prepare("UPDATE profiles SET fullName=?, about=?, company=?, job=?, country=?, address=?, phone=?, email=?, twitter=?, facebook=?, instagram=?, linkedin=? WHERE userId=?");
        
        // Bind parameters (12 parameters)
        $stmt->bind_param("sssssssssssi", 
            $formData['fullName'], 
            $formData['about'], 
            $formData['company'], 
            $formData['job'], 
            $formData['country'], 
            $formData['address'], 
            $formData['phone'], 
            $formData['email'], 
            $formData['twitter'], 
            $formData['facebook'], 
            $formData['instagram'], 
            $formData['linkedin'], 
            $formData['userId']
        );
    }

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the same page after successful update
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Make sure to call exit after header redirection
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
