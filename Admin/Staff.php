<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    <link rel="stylesheet" href="css/Staff.css">
</head>
<body>
    
<?php
include 'Component/Header.php';
?>

<section class="staff">
    <h1>Hospital Staff & Patients</h1>

    <div class="staffcontainer">

        <!-- staff Cards -->
        <div class="card">
            <div class="card-image">    
                <img src="../src/3774299.png" alt="Staff">
                <h2>Add a Staff</h2>
                <a href="StaffReg.php"><button class="card-button">Add</button></a>
            </div>
        </div>
    
        <!-- staff Cards -->
        <div class="card">
            <div class="card-image">    
                <img src="../src/3774299.png" alt="staff">
                <h2>View Staff</h2>
                <a href="ViewStaff.php"><button class="card-button">View</button></a>
            </div>
        </div>

                <!-- Patients Cards -->
                <div class="card">
            <div class="card-image">    
                <img src="../src/15090878.png" alt="patient">
                <h2>View Patients</h2>
                <a href="ViewPatients.php"><button class="card-button">View</button></a>
            </div>
        </div>


</section>     



<?php
include 'Component/Footer.php';
?>

</body>
</html>