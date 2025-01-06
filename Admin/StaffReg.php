<?php
session_start();
// Link database connection
require_once('../Connect.php');

if (isset($_POST['auth-button'])) {
    $EMP_NO = mysqli_real_escape_string($conp, $_POST['empno']);
    $Name = mysqli_real_escape_string($conp, $_POST['name']);
    $DOB = mysqli_real_escape_string($conp, $_POST['dob']);
    $Gender = mysqli_real_escape_string($conp, $_POST['gender']);
    $Email = mysqli_real_escape_string($conp, $_POST['email']);
    $Phone = mysqli_real_escape_string($conp, $_POST['phone']);
    $Password = mysqli_real_escape_string($conp, $_POST['password']);
    $Branch = mysqli_real_escape_string($conp, $_POST['hospital']);
    $Speciality = mysqli_real_escape_string($conp, $_POST['cat']);
    $hash_Password = md5($Password);

    // Check if EMP no already exists
    $checkEmpNoQuery = "SELECT * FROM staff WHERE emp_no = ? LIMIT 1";
    $stmt = mysqli_prepare($conp, $checkEmpNoQuery);
    mysqli_stmt_bind_param($stmt, 's', $EMP_NO);
    mysqli_stmt_execute($stmt);
    $checkEmpNoResult = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($checkEmpNoResult) > 0) {
        echo "<script>alert('Employee No already exists! Please use a different Employee No.');</script>";
        echo "<script>window.location.href='StaffReg.php';</script>";
        exit();
    }

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM staff WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conp, $checkEmailQuery);
    mysqli_stmt_bind_param($stmt, 's', $Email);
    mysqli_stmt_execute($stmt);
    $checkEmailResult = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        echo "<script>alert('Email already exists! Please use a different Email.');</script>";
        echo "<script>window.location.href='StaffReg.php';</script>";
        exit();
    }

    // Insert new record
    $insertQuery = "INSERT INTO staff (emp_no, name, dob, gender, email, phone, password, branch_id, speciality_id, IsAvailable)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
    $stmt = mysqli_prepare($conp, $insertQuery);
    mysqli_stmt_bind_param($stmt, 'sssssssii', $EMP_NO, $Name, $DOB, $Gender, $Email, $Phone, $hash_Password, $Branch, $Speciality);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Registration Successful!');</script>";
        echo "<script>window.location.href='StaffReg.php';</script>";
    } else {
        echo "<script>alert('Registration Failed: " . mysqli_error($conp) . "');</script>";
        echo "<script>window.location.href='StaffReg.php';</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Registration</title>
    <link rel="stylesheet" href="../Patient/css/Registration.css">
</head>
<body>

<div class="auth-container">
    <form class="auth-form" method="POST" onsubmit="return validateForm()">
        <h1>Care Compass Hospitals</h1>
        <h2>Staff Registration</h2>

        <div class="form-group">
            <input type="text" id="empno" name="empno" placeholder="Enter Employee Number" required>
        </div>

        <div class="form-group">
            <input type="text" id="name" name="name" placeholder="Enter Employee Name" required>
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


            <div class="form-group">
                <select id="hospital" name="hospital" required>
                    <option value="" disabled selected>Select Employee Hospital</option>
                    <option value="1">Kandy</option>
                    <option value="2">Colombo</option>
                    <option value="3">Kurunegala</option>
                </select>
            </div>

            <div class="form-group">
                <select id="cat" name="cat" required>
                    <option value="" disabled selected>Select the Employee Speciality</option>
                    <option value="1">Allergy and Immunology</option>
                    <option value="2">Anesthesiology</option>
                    <option value="3">Cardiology</option>
                    <option value="4">Dermatology</option>
                    <option value="5">Emergency Medicine</option>
                    <option value="6">Endocrinology</option>
                    <option value="7">Family Medicine</option>
                    <option value="8">Gastroenterology</option>
                    <option value="9">General Surgery</option>
                    <option value="10">Geriatrics</option>
                    <option value="11">Hematology</option>
                    <option value="12">Infectious Disease</option>
                    <option value="13">Internal Medicine</option>
                    <option value="14">Nephrology</option>
                    <option value="15">Neurology</option>
                    <option value="16">Neurosurgery</option>
                    <option value="17">Obstetrics and Gynecology (OB-GYN)</option>
                    <option value="18">Oncology</option>
                    <option value="19">Ophthalmology</option>
                    <option value="20">Orthopedics</option>
                    <option value="21">Otolaryngology (ENT)</option>
                    <option value="22">Pathology</option>
                    <option value="23">Pediatrics</option>
                    <option value="24">Physical Medicine and Rehabilitation</option>
                    <option value="25">Plastic Surgery</option>
                    <option value="26">Psychiatry</option>
                    <option value="27">Pulmonology</option>
                    <option value="28">Radiology</option>
                    <option value="29">Rheumatology</option>
                    <option value="32">Thoracic Surgery</option>
                    <option value="31">Urology</option>
                    <option value="32">Vascular Surgery</option>
                </select>
            </div>



        <button type="submit" name="auth-button" class="auth-button">Register</button>
        <p class="auth-link">Go to <a href="Dashboard.php">Home</a></p>
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