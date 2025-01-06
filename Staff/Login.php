<?php
session_start();
require_once('../Connect.php'); // Link database connection

if (isset($_POST['auth-button'])) {
    // Sanitize and escape input values
    $EMP_NO = mysqli_real_escape_string($conp, $_POST['empno']);
    $Password = md5(mysqli_real_escape_string($conp, $_POST['password'])); // Hash the password

    // Query to check user credentials
    $query = "SELECT * FROM staff WHERE emp_no = '{$EMP_NO}' AND password = '{$Password}' AND IsAvailable = '1' LIMIT 1";

    $result = mysqli_query($conp, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result); // Fetch user details

            // Set session variables
            $_SESSION['user'] = [
                'userName' => $row['name'], // Store the user's name
                'userId' => $row['empno'],    // Store the user's NIC
                'loggedIn' => true          // Indicate login status
            ];

            // Redirect to the dashboard
            header('Location:../Staff/Dashboard.php');
            exit;
        } else {
            // Invalid login details
            echo "<script>alert('Invalid Credentials');</script>";
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
    <title>Staff Login</title>
</head>
<body>
    
<link rel="stylesheet" href="../Staff/css/Registration.css">


<div class="auth-container">
    <form class="auth-form" method="POST" onsubmit="return validateForm()">
        <h1>Care Compass Hospitals</h1>
        <h2>Staff Login Portal</h2>

        <div class="form-group">
            <input type="text" id="empno" name="empno" placeholder="Enter Your Employee Number" required>
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
    </form>
</div>

</body>
</html>