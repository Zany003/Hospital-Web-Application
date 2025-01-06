<?php
require_once('../Connect.php');

$data = "
    SELECT 
        staff.emp_no, 
        staff.date, 
        staff.name, 
        staff.dob, 
        staff.gender, 
        staff.email, 
        staff.phone, 
        branch.location AS branch_location, 
        specialities.name AS speciality_name, 
        staff.IsAvailable
    FROM staff
    LEFT JOIN branch ON staff.branch_id = branch.branch_id
    LEFT JOIN specialities ON staff.speciality_id = specialities.speciality_id
";

$result_list = "";
$row_number = 1;

$result = mysqli_query($conp, $data);
if ($result) {
    while ($result1 = mysqli_fetch_assoc($result)) {
        $formatted_row_number = str_pad($row_number, 2, "0", STR_PAD_LEFT);
        $isAvailableStatus = ($result1['IsAvailable'] == 1) ? "Active" : "Inactive";

        $result_list .= "<tr>";
        $result_list .= "<td>{$formatted_row_number}</td>";
        $result_list .= "<td>{$result1['emp_no']}</td>";
        $result_list .= "<td>{$result1['date']}</td>";
        $result_list .= "<td>{$result1['name']}</td>";
        $result_list .= "<td>{$result1['dob']}</td>";
        $result_list .= "<td>{$result1['gender']}</td>";
        $result_list .= "<td>{$result1['email']}</td>";
        $result_list .= "<td>{$result1['phone']}</td>";
        $result_list .= "<td>{$result1['branch_location']}</td>";
        $result_list .= "<td>{$result1['speciality_name']}</td>";
        $result_list .= "<td>{$isAvailableStatus}</td>";
        $result_list .= "<td><a href=\"DeleteStaff.php?emp_no={$result1['emp_no']}\"><button>Deactivate</button></a></td>";
        $result_list .= "<td><a href=\"ActiveStaff.php?emp_no={$result1['emp_no']}\"><button>Activate</button></a></td>";
        $result_list .= "</tr>";

        $row_number++;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Staff</title>
    <link rel="stylesheet" href="css/ViewStaff.css">
</head>
<body>
    
<?php include 'Component/Header.php'; ?>

<!-- View Staff Section -->
<section class="viewstaff">
    <div class="content">
        <div class="text-content">
            <h1>View Staff</h1>
            <span>Home / Staff & Patients / <b>View Staff</b></span>
        </div>
        <div class="image-content">
            <img src="../src/25.jpg" alt="Staff Image">
        </div>
    </div>
</section>



<!-- Staff Table -->
<div class="table-container">
    <h1>Staff Details</h1>

<!-- Search Bar -->
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search by name, email, branch, or specialty..." onkeyup="filterTable()">
</div>

    <table id="staffTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Employee No</th>
                <th>Reg. Date</th>
                <th>Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Branch</th>
                <th>Speciality</th>
                <th>Status</th>
                <th>Deactivate</th>
                <th>Activate</th>
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
        const table = document.getElementById("staffTable");
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
