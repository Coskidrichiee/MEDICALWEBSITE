<?php
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $organization = $conn->real_escape_string($_POST['organization']);
    $address = $conn->real_escape_string($_POST['address']);
    $job = $conn->real_escape_string($_POST['job']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the email already exists
    $check_email_sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check_email_sql);

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>alert('Error: Email already registered. Please use a different email.');</script>";
    } else {
        // Generate a random confirmation code
        $confirmationCode = rand(100000, 999999);

        // Insert the data into the database with 'pending' status
        $sql = "INSERT INTO users (name, email, phone, organization, address, job, password, confirmation_code, status)
        VALUES ('$name', '$email', '$phone', '$organization', '$address', '$job', '$password', '$confirmationCode', 'pending')";

        if ($conn->query($sql) === TRUE) {
            // Send the confirmation code via email
            mail($email, "Your Confirmation Code", "Your confirmation code is: $confirmationCode");

            // Redirect to confirmation page with the email parameter
            echo "<script>
                    alert('Account created successfully! Please check your email for the confirmation code.');
                    window.location.href = 'confirm_email.php?email=$email';
                  </script>";
        } else {
            // Display an error if the query fails
            echo "<script>alert('Error: Unable to create account. Please try again later.');</script>";
        }
    }
}

$conn->close();
?>
