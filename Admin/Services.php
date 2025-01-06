<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="css/Services.css">
    
</head>
<body>

<?php
include 'Component/Header.php';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Services Section -->
<section class="Services">
    <div class="content">
        <div class="text-content">
            <h1>Services</h1>
            <p>Home / <b>Services</b></p>
        </div>
        <div class="image-content">
            <img src="../src/12.jpg" alt="Services Image">
        </div>
    </div>
</section>

<!-- Search Bar -->
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search for services..." onkeyup="filterServices()">
</div>

<!-- Medical Services -->
<section class="services-header">
    <h2>Medical Services</h2>
    <ul class="service-list">
        <li><a href="">General Medicine</a></li>
        <li><a href="#">Emergency Services</a></li>
        <li><a href="#">Surgery</a></li>
        <li><a href="#">Pediatrics</a></li>
        <li><a href="#">Cardiology</a></li>
        <li><a href="#">Oncology</a></li>
        <li><a href="#">Obstetrics and Gynecology</a></li>
        <li><a href="#">Neurology</a></li>
        <li><a href="#">Orthopedics</a></li>
        <li><a href="#">Dermatology</a></li>
        <li><a href="#">Psychiatry and Mental Health</a></li>
        <li><a href="#">ENT (Ear, Nose, Throat)</a></li>
        <li><a href="#">Ophthalmology</a></li>
    </ul>
</section>

<!-- Diagnostics and Lab Services -->
<section class="services-header">
    <h2>Diagnostics and Lab Services</h2>
    <ul class="service-list">
        <li><a href="#">Blood Tests</a></li>
        <li><a href="#">Imaging (X-Ray, MRI, CT Scan, Ultrasound)</a></li>
        <li><a href="#">Pathology</a></li>
        <li><a href="#">Endoscopy</a></li>
        <li><a href="#">Genetic Testing</a></li>
    </ul>
</section>

<!-- Specialty Clinics -->
<section class="services-header">
    <h2>Specialty Clinics</h2>
    <ul class="service-list">
        <li><a href="#">Diabetes Care</a></li>
        <li><a href="#">Fertility Clinic</a></li>
        <li><a href="#">Weight Management and Bariatrics</a></li>
        <li><a href="#">Rehabilitation and Physiotherapy</a></li>
        <li><a href="#">Pain Management Clinic</a></li>
        <li><a href="#">Smoking Cessation Programs</a></li>
    </ul>
</section>

<!-- Preventive Healthcare -->
<section class="services-header">
    <h2>Preventive Healthcare</h2>
    <ul class="service-list">
        <li><a href="#">Health Check-Up Packages</a></li>
        <li><a href="#">Vaccination Programs</a></li>
        <li><a href="#">Wellness Programs</a></li>
        <li><a href="#">Nutrition and Diet Counseling</a></li>
    </ul>
</section>

<!-- Patient Support Services -->
<section class="services-header">
    <h2>Patient Support Services</h2>
    <ul class="service-list">
        <li><a href="#">Telemedicine and Virtual Consultations</a></li>
        <li><a href="#">Health Insurance Assistance</a></li>
        <li><a href="#">Pharmacy</a></li>
        <li><a href="#">Ambulance Services</a></li>
        <li><a href="#">Medical Tourism</a></li>
    </ul>
</section>

<!-- Surgical Services -->
<section class="services-header">
    <h2>Surgical Services</h2>
    <ul class="service-list">
        <li><a href="#">Day Care Surgeries</a></li>
        <li><a href="#">Minimally Invasive Surgeries</a></li>
        <li><a href="#">Cosmetic and Plastic Surgery</a></li>
    </ul>
</section>

<!-- Specialized Units -->
<section class="services-header">
    <h2>Specialized Units</h2>
    <ul class="service-list">
        <li><a href="#">ICU</a></li>
        <li><a href="#">NICU</a></li>
        <li><a href="#">Dialysis Unit</a></li>
        <li><a href="#">Trauma and Burn Unit</a></li>
    </ul>
</section>

<!-- Wellness and Lifestyle Services -->
<section class="services-header">
    <h2>Wellness and Lifestyle Services</h2>
    <ul class="service-list">
        <li><a href="#">Physiotherapy</a></li>
        <li><a href="#">Yoga and Meditation</a></li>
        <li><a href="#">Stress Management Programs</a></li>
    </ul>
</section>

<!-- Facilities -->
<section class="services-header">
    <h2>Facilities</h2>
    <ul class="service-list">
        <li>Parking</li>
        <li>Free WiFi</li>
        <li>Food Courts/Cafeterias</li>
    </ul>
</section>




<script>
    function filterServices() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const serviceSections = document.querySelectorAll(".services-header");
        const noResultsMessage = document.getElementById("noResultsMessage");
        let anyMatch = false;

        serviceSections.forEach(section => {
            const heading = section.querySelector("h2");
            const items = section.querySelectorAll(".service-list li");
            let sectionHasMatch = false;

            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                const itemText = item.textContent;

                if (text.includes(input)) {
                    item.style.display = "list-item";
                    item.innerHTML = highlightMatch(itemText, input);
                    sectionHasMatch = true;
                } else {
                    item.style.display = "none";
                }
            });

            // Show or hide the section based on matches
            heading.style.display = sectionHasMatch ? "block" : "none";
            section.style.display = sectionHasMatch ? "block" : "none";

            if (sectionHasMatch) {
                anyMatch = true;
            }
        });

        // Show or hide the "No results found" message
        noResultsMessage.style.display = anyMatch ? "none" : "block";
    }

    function highlightMatch(text, query) {
        const regex = new RegExp(`(${query})`, "gi");
        return text.replace(regex, "<span style='background-color: yellow;'>$1</span>");
    }
</script>

<?php
include 'Component/Footer.php';
?>

</body>
</html>