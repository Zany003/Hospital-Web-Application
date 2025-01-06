
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Compass Hospitals</title>
    <link rel="stylesheet" href="css/Dashboard.css">
</head>
<body>

<?php
include 'Component/Header.php';
?>

<!-- Carousel Section -->
<section class="carousel">
    <div class="slides">
        <img src="../src/3.jpg" alt="Healthcare facilities" class="slide-image">
        <img src="../src/4.jpg" alt="Medical experts" class="slide-image">
        <img src="../src/5.jpg" alt="Advanced equipment" class="slide-image">
        <img src="../src/6.jpg" alt="Patient care" class="slide-image">
        <img src="../src/7.jpg" alt="Modern healthcare facilities" class="slide-image">
        <img src="../src/8.jpg" alt="Advanced patient care" class="slide-image">
        <img src="../src/9.jpg" alt="Modern healthcare facilities" class="slide-image">
    </div>
</section>


<script>
    let currentIndex = 0;

    function carousel() {
    const slides = document.getElementsByClassName("slide-image");
    
    // Hide all slides
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }
    
    // Show the current slide
    currentIndex++;
    if (currentIndex > slides.length) {
        currentIndex = 1; // Reset to the first slide
    }
    slides[currentIndex - 1].classList.add("active"); // Add the active class to current slide

    setTimeout(carousel, 4000); // Change slide every 4 seconds
    }

    // Start the carousel when the page loads
    window.onload = carousel;
</script>

<section class="choose-us">
    <h2>Why Patients Choose Care Compass Hospitals</h2>
    <ul>
        <li><strong>Care Compass Hospitals brings together the most dedicated, skilled, and experienced healthcare professionals, offering cutting-edge, evidence-based clinical programs designed to address the most complex medical conditions through our Centres of Excellence. Our unwavering commitment to exceptional patient outcomes has earned us a reputation as a trusted leader in Sri Lanka’s private healthcare sector.</strong> </li>
        <li><strong>We are also at the forefront of managing lifestyle-related health conditions, promoting preventive healthcare, and providing a comprehensive range of advanced diagnostic tests.</strong></li>
        <li><strong>Care Compass Hospitals is proud to uphold international standards of excellence in patient safety and care, ensuring every patient receives the highest quality treatment in a compassionate environment.</strong></li>
    </ul>
</section>


<!-- Choose Us Images -->
<section class="choose-us-img">
    <img src="../src/10.jpg" alt="Modern facilities at Care Compass Hospitals">
</section>

<!-- Statistics Section -->
<div class="stats-container">
    <div class="stat-item">
        <h2>800+</h2>
        <p>Consultants</p>
    </div>
    <div class="divider"></div>
    <div class="stat-item">
        <h2>3500+</h2>
        <p>Consultations Per Day</p>
    </div>
    <div class="divider"></div>
    <div class="stat-item">
        <h2>4250+</h2>
        <p>Tests Offered</p>
    </div>
    <div class="divider"></div>
    <div class="stat-item">
        <h2>14500+</h2>
        <p>Tests Per Day</p>
    </div>
    <div class="divider"></div>
    <div class="stat-item">
        <h2>800+</h2>
        <p>Beds</p>
    </div>
</div>


<?php
include 'Component/Footer.php';
?>

</body>
</html>