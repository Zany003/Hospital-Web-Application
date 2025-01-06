<?php
include '../Connect.php';

if (isset($_POST['submit'])) {

    $Name = mysqli_real_escape_string($conp, $_POST['name']);
    $Email = mysqli_real_escape_string($conp, $_POST['email']);
    $Vist_Date = mysqli_real_escape_string($conp, $_POST['visit_date']);
    $Raiting = mysqli_real_escape_string($conp, $_POST['rating']);
    $Comments = mysqli_real_escape_string($conp, $_POST['comments']);

    // Insert feedback into database
    $query = "INSERT INTO feedback (name, email, visit_date,  rating, comments  ) 
              VALUES ('$Name', '$Email', '$Vist_Date', '$Raiting', '$Comments') ";

    if (mysqli_query($conp, $query)) {
        echo "<script>alert('Feedback Submitted Successfully!'); window.location.href='Dashboard.php';</script>";
    } else {
        echo "<script>alert('Error Feedback Submitting. Please try again.'); window.location.href='Feedback.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="css/Feedback.css">
</head>
<body>
    
<?php
include 'Component/Header.php';
?>

<!-- About Us Section -->
<section class="feedback"> 
    <div class="content">
        <div class="text-content">
            <h1>Feedback</h1>
            <span>Home / <b>Feedback</b></span>
        </div>
        <div class="image-content">
            <img src="../src/21.jpg" alt="Feedback Image">
        </div>
    </div>
</section>

<section class = fbform>
    <form action="" method="POST">
    <div class= fdcontainer>
        <h2>Feedback Form</h2>

        <div class="form-row">
            <div class="form-group">
                <label for="name">Full Name (Optional):</label>
                <input type="text" id="name" name="name" placeholder="Enter Your Name">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email (Optional)</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="visit-date">Date of Visit</label>
                <input type="date" id="visit-date" name="visit_date" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
            <label>Overall Experience (Rate with Stars):</label>
            <div class="stars">

                
                <input type="radio" id="star5" name="rating" value="5" required>
                <label for="star5">&#9733;</label>

                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4">&#9733;</label>

                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3">&#9733;</label>

                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2">&#9733;</label>

                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1">&#9733;</label>
            </div>
        </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="comments">Additional Comments:</label>
                <textarea id="comments" name="comments" rows="5" placeholder="Share your feedback here..."></textarea>
            </div>
        </div>
        <button type="submit" name="submit">Submit Feedback</button>
    </form>
    </div>
</section>



<?php
include 'Component/Footer.php';
?>

</body>
</html>