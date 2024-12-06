<?php
session_start(); // Start the session

// Database connection parameters
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

// Handle form submission for login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    // Retrieve and sanitize form data
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true);

            // Set session variables for the logged-in user
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = htmlspecialchars($row['name']); // Assuming 'name' is the user's name
            $_SESSION['job'] = htmlspecialchars($row['job']);       // Store user's job
            $_SESSION['profile_image'] = htmlspecialchars($row['profile_image']); // Store the user's profile image

            // Output JavaScript to alert and redirect
            echo "<script type='text/javascript'>
                    alert('Sign-in successful! Redirecting to your profile...');
                    window.location.href = 'profile.php';
                  </script>";
            exit(); // Stop the script after outputting the alert and redirect
        } else {
            // Invalid password
            echo "<script>alert('Invalid password. Please try again.'); window.location.href='login.html';</script>";
        }
    } else {
        // Email not found
        echo "<script>alert('Email not found. Please sign up or try again.'); window.location.href='signup.html';</script>";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
