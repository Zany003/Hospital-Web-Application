<?php
session_start();
require_once('../Connect.php'); // Link database connection

if (isset($_POST['auth-button'])) {
    // Sanitize and escape input values
    $NIC = mysqli_real_escape_string($conp, $_POST['nic']);
    $Password = md5(mysqli_real_escape_string($conp, $_POST['password'])); // Hash the password

    // Query to check user credentials
    $query = "SELECT * FROM patients WHERE nic = '{$NIC}' AND password = '{$Password}' AND IsAvailable = '1' LIMIT 1";

    $result = mysqli_query($conp, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result); // Fetch user details

            // Set session variables
            $_SESSION['user'] = [
                'userName' => $row['name'], // Store the user's name
                'userId' => $row['nic'],    // Store the user's NIC
                'loggedIn' => true          // Indicate login status
            ];

            // Redirect to the dashboard
            header('Location:../Patient/Dashboard.php');
            exit;
        } else {
            // Invalid login details
            echo "<script>alert('Invalid NIC or Password');</script>";
        }
    } else {
        // Database query failure
        echo "<script>alert('Database Query Failed: " . mysqli_error($conp) . "');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
</head>
<body>
    
<link rel="stylesheet" href="../Patient/css/Registration.css">


<div class="auth-container">
    <form class="auth-form" method="POST" onsubmit="return validateForm()">
        <h1>Care Compass Hospitals</h1>
        <h2>Patient Login Portal</h2>

        <div class="form-group">
            <input type="text" id="nic" name="nic" placeholder="Enter Your NIC" required>
        </div>

        <div class="form-group password-group">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span class="password-toggle" onclick="togglePassword('password', this)">👁️</span>
        </div>

        <script>
    function togglePassword(inputId, toggleElement) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            toggleElement.style.opacity = '0.5';
        } else {
            input.type = 'password';
            toggleElement.style.opacity = '1';
        }
    }
    </script>

        <button type="submit" name="auth-button" class="auth-button">Login</button>
        <p class="auth-link">Don't have an account? <a href="Registration.php">Sign Up</a></p>
    </form>
</div>

</body>
</html>