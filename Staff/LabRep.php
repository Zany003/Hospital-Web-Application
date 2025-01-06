<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Reports</title>
    <link rel="stylesheet" href="css/LabRep.css">
</head>
<body>
    
<?php
include 'Component/Header.php';
?>

<!-- Lab Reports  head Section -->
<section class="LabReports">
    <div class="content">
        <div class="text-content">
        <h1>Laboratory Reports</h1>
        <span>Home / <b>Laboratory Reports</b></span>
        </div>
        <div class="image-content">
            <img src="../src/19.jpg" alt=" LabReports Image">
        </div>
    </div>
</section>

<section class="labrep">
    <h1>Laboratory Reports</h1>

    <div class="labrepcontainer">

        <!-- labrep Cards -->
        <div class="card">
            <div class="card-image">    
                <img src="../src/20.jpg" alt="labrep">
                <h2>Reports</h2>
                <a href="LabReports.php"><button class="card-button">Upload</button></a>
            </div>
        </div>
    
        <!-- labrep Cards -->
        <div class="card">
            <div class="card-image">    
                <img src="../src/20.jpg" alt="labrep">
                <h2>Reports</h2>
                <a href="ViewLabReports.php"><button class="card-button">View</button></a>
            </div>
        </div>


</section>     



<?php
include 'Component/Footer.php';
?>

</body>
</html>