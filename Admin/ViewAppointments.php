<?php
require_once('../Connect.php');

// SQL query with corrected joins and aliases
$data = "
    SELECT 
        appointment.appointment_id, 
        appointment.create_at, 
        appointment.patient_name, 
        appointment.age, 
        appointment.gender, 
        appointment.email, 
        appointment.phone, 
        branch.location AS branch_location, 
        specialities.name AS speciality_name, 
        staff.name AS staff_name
    FROM appointment
    LEFT JOIN staff ON appointment.emp_no = staff.emp_no
    LEFT JOIN branch ON staff.branch_id = branch.branch_id
    LEFT JOIN specialities ON staff.speciality_id = specialities.speciality_id
";

$result_list = "";
$row_number = 1; // Start row numbering

// Execute the query
$result = mysqli_query($conp, $data);
if ($result) {
    while ($result1 = mysqli_fetch_assoc($result)) {
        $formatted_row_number = str_pad($row_number, 2, "0", STR_PAD_LEFT);

        // Construct table rows
        $result_list .= "<tr>";
        $result_list .= "<td>{$formatted_row_number}</td>";
        $result_list .= "<td>{$result1['appointment_id']}</td>";
        $result_list .= "<td>{$result1['create_at']}</td>";
        $result_list .= "<td>{$result1['patient_name']}</td>";
        $result_list .= "<td>{$result1['age']}</td>";
        $result_list .= "<td>{$result1['gender']}</td>";
        $result_list .= "<td>{$result1['email']}</td>";
        $result_list .= "<td>{$result1['phone']}</td>";
        $result_list .= "<td>{$result1['branch_location']}</td>";
        $result_list .= "<td>{$result1['speciality_name']}</td>";
        $result_list .= "<td>{$result1['staff_name']}</td>";
        $result_list .= "</tr>";

        $row_number++;
    }
} else {
    // Fallback if query fails or returns no results
    $result_list = "<tr><td colspan='11' style='text-align:center;'>No appointments found.</td></tr>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments Details</title>
    <link rel="stylesheet" href="css/ViewAppointments.css">
</head>
<body>
    
<?php include 'Component/Header.php'; ?>

<!-- View Staff Section -->
<section class="viewappointment">
    <div class="content">
        <div class="text-content">
            <h1>Appointments</h1>
            <span>Home / <b>Appointments</b></span>
        </div>
        <div class="image-content">
            <img src="../src/17.jpg" alt="Appointments Image">
        </div>
    </div>
</section>



<!-- Appointments Table -->
<div class="table-container">
    <h1>Appointments Details</h1>

<!-- Search Bar -->
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search by name, email, phone, branch, or specialty..." onkeyup="filterTable()">
</div>

    <table id="AppointmentsTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Appointments ID</th>
                <th>Create at</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Branch</th>
                <th>Speciality</th>
                <th>Doctor</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $result_list; ?>
        </tbody>
    </table>
</div>

<?php include 'Component/Footer.php'; ?>

<!-- sear bar -->
<script>
    function filterTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const table = document.getElementById("AppointmentsTable");
        const rows = table.querySelectorAll("tbody tr");
        let hasMatch = false;

        rows.forEach(row => {
            const cells = row.querySelectorAll("td");
            const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(" ");
            if (rowText.includes(input)) {
                row.style.display = "";
                hasMatch = true;
            } else {
                row.style.display = "none";
            }
        });

        if (!hasMatch) {
            const noResultsRow = document.getElementById("noResultsRow");
            if (!noResultsRow) {
                const tbody = table.querySelector("tbody");
                const newRow = document.createElement("tr");
                newRow.id = "noResultsRow";
                newRow.innerHTML = `<td colspan="13" style="text-align:center;">No results found.</td>`;
                tbody.appendChild(newRow);
            }
        } else {
            const noResultsRow = document.getElementById("noResultsRow");
            if (noResultsRow) noResultsRow.remove();
        }
    }
</script>

</body>
</html>
