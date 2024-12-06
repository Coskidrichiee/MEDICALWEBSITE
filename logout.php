<?php
session_start();
session_destroy(); // Destroy the session
header("Location: index.html"); // Redirect to homepage or login page
exit();
?>
