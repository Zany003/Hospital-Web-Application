<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user']['loggedIn']) || !$_SESSION['user']['loggedIn']) {
    header('Location:../Staff/Login.php'); // Redirect to the login page if not logged in
    exit;   
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<link rel="stylesheet" href="css/Header.css">

<!-- font link -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet"> 


<!-- Logo Section -->
<section class="logo-container">
    <a href="../Staff/Dashboard.php">
        <img src="../src/1.png" alt="Care Compass Hospitals Logo" class="logo">
    </a>
</section>

<!-- Emergency Contact -->
<section class="emergency-contact">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <a href="tel:6969" class="emergency-link">
    <i class="fas fa-phone"></i><strong> 24/7 Emergency: 6969</strong>  
    </a>
</section>

<!-- Quick Links -->
<section id="head">
    <ul class="quick-links">
    
        <li><?php echo "<h1>Hello! " . htmlspecialchars($_SESSION['user']['userName']) . "</h1>";?></li>                      

    </ul>
</section>

<!-- Logout Button -->
<section class="logout">
    <a href="../Staff/Logout.php" class="logout-button">Logout</a>
</section>


<!-- Header Section -->
<header>
    <div class="container">
        <h1>Care Compass Hospitals</h1>
        <h3>Guiding Your Journey to Better Health</h3>
        <nav>
            <ul>
                <li><a href="../Staff/Dashboard.php">Home</a></li>
                <li><a href="../Staff/Services.php">Services</a></li>
                <li><a href="../Staff/Appointments.php">Appointments</a></li>
                <li><a href="../Staff/LabRep.php">Laboratory Reports</a></li>
                <li><a href="../Staff/BillPayments.php">Bill Payments</a></li>
                <li><a href="../Staff/Inquiries.php">Inquiries</a></li>
                <li><a href="../Staff/Feedback.php">Feedback</a></li>
            </ul>
        </nav>
    </div>
</header>



</body>
</html>