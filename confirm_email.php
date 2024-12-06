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

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email and entered confirmation code from the form
    $email = $_POST['email'];
    $enteredCode = $_POST['confirmation_code'];

    // Sanitize inputs to prevent SQL injection
    $email = $conn->real_escape_string($email);
    $enteredCode = $conn->real_escape_string($enteredCode);

    // Query to retrieve the confirmation code from the database
    $query = "SELECT confirmation_code FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($confirmationCode);
    $stmt->fetch();
    $stmt->close();

    // Debugging: Check what value is being retrieved
    // echo "Database confirmation code: " . $confirmationCode;
    // echo "Entered confirmation code: " . $enteredCode;

    // Check if the confirmation code is correct
    if ($confirmationCode && $confirmationCode == $enteredCode) {
        // Update the user's status to "confirmed"
        $updateQuery = "UPDATE users SET status = 'confirmed' WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("s", $email);

        if ($updateStmt->execute()) {
            echo "<script>
                    alert('Your account has been confirmed. You can now sign in.');
                    window.location.href = 'signup.html';
                  </script>";
        } else {
            echo "<script>alert('Error updating account status. Please try again later.');</script>";
        }
        $updateStmt->close();
    } else {
        echo "<script>alert('Invalid confirmation code.');</script>";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Email</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f4f6f8;
}

form {
    width: 300px;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

form h1 {
    margin-bottom: 1em;
    color: #333;
    text-align: center;
}

label {
    font-weight: bold;
    color: #555;
    margin-bottom: 5px;
    display: inline-block;
}

input[type="text"],
input[type="hidden"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

input[type="text"]:focus {
    border-color: #007bff;
    outline: none;
}

button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #ffffff;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <form action="confirm_email.php" method="POST">
        <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
        <label for="confirmation_code">Enter your confirmation code:</label>
        <input type="text" name="confirmation_code" required>
        <button type="submit">Confirm</button>
    </form>
</body>
</html>
