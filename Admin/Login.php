<?php

session_start();
require_once('../Connect.php');  //link db connection

if (isset($_POST['Login'])){
    $AdId = mysqli_real_escape_string($conp,$_POST['admid']);
    $Password = mysqli_real_escape_string($conp,$_POST['password']);

    $query = "SELECT * FROM admin WHERE admin_no ='{$AdId}' AND password = '{$Password}' AND IsAvailable = '1' LIMIT 1";


    $result = mysqli_query($conp,$query);
    
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result); // Fetch the admin details
            $_SESSION['user'] = [
                'userName' => $row['name'], // Store the admin's name in the session
                'adminId' => $AdId,         // Store the admin number
                'loggedin' => true
            ];
            header('Location: ../Admin/Dashboard.php'); // Redirect to the dashboard
            exit;
        } else {
            echo "<script>alert('Invalid Login Details');</script>";
        }
    } else {
        echo "<script>alert('Database Query Failed');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
<link rel="stylesheet" href="../Admin/css/Login.css">

<h1>Care Compass Hospitals</h1>
<h2>Admin Login Portal</h2>

<main>
    <section class= 'section'>
        <form action=""method ='POST' >
        <label for="">Staff ID</label>
        <input type="text" placeholder = "Enter Your Staff ID" name = "admid" required>
        <label for="">Password</label>
            <input type="password" placeholder = "Enter Your Password" name = "password" required>

            <button type = "Submit" name = "Login" >Login</button>

        </form>
    </section>
</main>

</body>
</html>