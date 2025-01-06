<?php
include '../Connect.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conp, $_POST['name']);
    $age = mysqli_real_escape_string($conp, $_POST['age']);
    $gender = mysqli_real_escape_string($conp, $_POST['gender']);
    $email = mysqli_real_escape_string($conp, $_POST['email']);
    $phone = mysqli_real_escape_string($conp, $_POST['phone']);
    $hospital = mysqli_real_escape_string($conp, $_POST['hospital']);
    $specialty = mysqli_real_escape_string($conp, $_POST['specialty']);
    $doctor = mysqli_real_escape_string($conp, $_POST['doctor']);
    $date = mysqli_real_escape_string($conp, $_POST['date']);
    $time = mysqli_real_escape_string($conp, $_POST['time']);
    $message = mysqli_real_escape_string($conp, $_POST['message']);

    // Insert appointment into database
    $query = "INSERT INTO appointment (patient_name, age, gender, email, phone, branch_id, speciality_id, emp_no, appointment_date, appointment_time, message) 
              VALUES ('$name', '$age', '$gender', '$email', '$phone', '$hospital', '$specialty', '$doctor', '$date', '$time', '$message')";

    if (mysqli_query($conp, $query)) {
        echo "<script>alert('Appointment Booked Successfully!'); window.location.href='Dashboard.php';</script>";
    } else {
        echo "<script>alert('Error Booking Appointment. Please try again.'); window.location.href='Appointment.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="css/Appointment.css">
</head>
<body>
    <?php include 'Component/Header.php'; ?>

    <section class="appointment">
        <div class="content">
            <div class="text-content">
                <h1>Appointment</h1>
                <span>Home / <b>Appointment</b></span>
            </div>
            <div class="image-content">
                <img src="../src/17.jpg" alt="Appointments Image">
            </div>
        </div>
    </section>

    <section class="app">
        <form action="" method="POST">
            <div class="appointment-container">
                <h1>Book Your Doctor Now!</h1>
               

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter Patient's Name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" max= "100" min = "1" placeholder="Enter Patient's Age" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="" disabled selected>Select Patient's Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required pattern="[0-9]{10}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="hospital">Select Hospital</label>
                    <select id="hospital" name="hospital" required>
                        <option value="" disabled selected>Select Hospital</option>
                        <?php
                        $query = "SELECT branch_id, location FROM branch";
                        $result = mysqli_query($conp, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['branch_id'] . "'>" . $row['location'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="specialty">Select Speciality</label>
                    <select id="specialty" name="specialty" required>
                        <option value="" disabled selected>Select Speciality</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="doctor">Select Doctor</label>
                    <select id="doctor" name="doctor" required>
                        <option value="" disabled selected>Select Doctor</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date">Appointment Date</label>
                        <input type="date" id="date" name="date" required>
                    </div>


                    <script>
                        // Get today's date in the local timezone
                        const today = new Date();
                        const year = today.getFullYear();
                        const month = String(today.getMonth() + 1).padStart(2, '0'); // Add leading zero
                        const day = String(today.getDate()).padStart(2, '0'); // Add leading zero

                        // Format as YYYY-MM-DD
                        const formattedDate = `${year}-${month}-${day}`;

                        // Set the min attribute
                        document.getElementById('date').setAttribute('min', formattedDate);
                    </script>

                    
                    <div class="form-group">
                        <label for="time">Appointment Time</label>
                        <select id="time" name="time" required>
                            <option value="">Select a time</option>
                            <option value="10:30">10:30 AM</option>
                            <option value="16:30">4:30 PM</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Enter any additional details (optional)"></textarea>
                </div>

                <button type="submit" name="submit">Book Appointment</button>
            </div>
        </form>
    </section>

    <script>
        document.getElementById('hospital').addEventListener('change', function() {
            const specialtySelect = document.getElementById('specialty');
            const selectedHospital = this.value;
            
            fetch('Specialties.php?branch_id=' + selectedHospital)
                .then(response => response.json())
                .then(data => {
                    specialtySelect.innerHTML = '<option value="">Select Specialty</option>';
                    document.getElementById('doctor').innerHTML = '<option value="">Select Doctor</option>';
                    
                    data.forEach(specialty => {
                        const option = document.createElement('option');
                        option.value = specialty.speciality_id;
                        option.textContent = specialty.name;
                        specialtySelect.appendChild(option);
                    });
                });
        });

        document.getElementById('specialty').addEventListener('change', function() {
            const doctorSelect = document.getElementById('doctor');
            const selectedSpecialty = this.value;
            const selectedHospital = document.getElementById('hospital').value;
            
            fetch(`Doctors.php?speciality_id=${selectedSpecialty}&branch_id=${selectedHospital}`)
                .then(response => response.json())
                .then(data => {
                    doctorSelect.innerHTML = '<option value="">Select Doctor</option>';
                    
                    data.forEach(doctor => {
                        const option = document.createElement('option');
                        option.value = doctor.emp_no;
                        option.textContent = doctor.name;
                        doctorSelect.appendChild(option);
                    });
                });
        });
    </script>

    <?php include 'Component/Footer.php'; ?>
</body>
</html>