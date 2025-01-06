<?php
session_start();
// Link database connection
require_once('../Connect.php');

if (isset($_POST['auth-button'])) {
    $Name = mysqli_real_escape_string($conp, $_POST['name']);
    $NIC = mysqli_real_escape_string($conp, $_POST['nic']);
    $DOB = mysqli_real_escape_string($conp, $_POST['dob']);
    $Gender = mysqli_real_escape_string($conp, $_POST['gender']);
    $Email = mysqli_real_escape_string($conp, $_POST['email']);
    $Phone = mysqli_real_escape_string($conp, $_POST['phone']);
    $Password = mysqli_real_escape_string($conp, $_POST['password']);
    $hash_Password = md5($Password);

    // Check if NIC already exists
    $checkNICQuery = "SELECT * FROM patients WHERE nic = ? LIMIT 1";
    $stmt = mysqli_prepare($conp, $checkNICQuery);
    mysqli_stmt_bind_param($stmt, 's', $NIC);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($checkResult) > 0) {
        // NIC already exists
        echo "<script>alert('NIC already exists! Please use a different NIC.');</script>";
        echo "<script>window.location.href='Registration.php';</script>";
    } else {
        // Insert new record
        $Insert = "INSERT INTO patients (name, nic, dob, gender, email, phone, password, IsAvailable)
                   VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
        $stmt = mysqli_prepare($conp, $Insert);
        mysqli_stmt_bind_param($stmt, 'sssssss', $Name, $NIC, $DOB, $Gender, $Email, $Phone, $hash_Password);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Registration Successful!');</script>";
            echo "<script>window.location.href='Login.php';</script>";
        } else {
            echo "<script>alert('Registration Failed: " . mysqli_error($conp) . "');</script>";
            echo "<script>window.location.href='Registration.php';</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link rel="stylesheet" href="../Patient/css/Registration.css">
</head>
<body>

<div class="auth-container">
    <form class="auth-form" method="POST" onsubmit="return validateForm()">
        <h1>Care Compass Hospitals</h1>
        <h2>Patient Registration</h2>

        <div class="form-group">
            <input type="text" id="name" name="name" placeholder="Enter Your Full Name" required>
        </div>

        <div class="form-group">
            <input type="text" id="nic" name="nic" placeholder="Enter Your NIC" required>
        </div>

        <div class="form-group">
            <input type="date" id="dob" name="dob" required>
        </div>

        <div class="form-group">
            <select  name="gender" required>
                <option value="">Select Your Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="form-group">
            <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
        </div>

        <div class="form-group">
            <input type="text" name="phone" placeholder="Enter Your Contact Number" required pattern="\d{10}" title="Please enter a valid 10-digit phone number">
        </div>

        <div class="form-group password-group">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span class="password-toggle" onclick="togglePassword('password', this)">👁️</span>
        </div>

        <div class="form-group password-group">
            <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
            <span class="password-toggle" onclick="togglePassword('confirmPassword', this)">👁️</span>
        </div>

        <button type="submit" name="auth-button" class="auth-button">Sign Up</button>
        <p class="auth-link">Already have an account? <a href="Login.php">Login</a></p>
    </form>
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

    function validateForm() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            return false;
        }
        return true;
    }

    // Enable form submission with Enter key
    document.querySelector('.auth-form').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.querySelector('.auth-button').click();
        }
    });
</script>

</body>
</html>
