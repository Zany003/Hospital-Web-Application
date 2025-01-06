<?php
require_once('../Connect.php');

$data = "SELECT * FROM patients";

$result_list = "";
$row_number = 1;

$result = mysqli_query($conp, $data);
if ($result) {
    while ($result1 = mysqli_fetch_assoc($result)) {
        $formatted_row_number = str_pad($row_number, 2, "0", STR_PAD_LEFT);
        $isAvailableStatus = ($result1['IsAvailable'] == 1) ? "Active" : "Inactive";

        $result_list .= "<tr>";
        $result_list .= "<td>{$formatted_row_number}</td>";
        $result_list .= "<td>{$result1['nic']}</td>";
        $result_list .= "<td>{$result1['date']}</td>";
        $result_list .= "<td>{$result1['name']}</td>";
        $result_list .= "<td>{$result1['dob']}</td>";
        $result_list .= "<td>{$result1['gender']}</td>";
        $result_list .= "<td>{$result1['email']}</td>";
        $result_list .= "<td>{$result1['phone']}</td>";
        $result_list .= "<td>{$isAvailableStatus}</td>";
        $result_list .= "<td><a href=\"DeletePatients.php?nic={$result1['nic']}\"><button>Deactivate</button></a></td>";
        $result_list .= "<td><a href=\"ActivePatients.php?nic={$result1['nic']}\"><button>Activate</button></a></td>";
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
    <link rel="stylesheet" href="css/ViewPatients.css">
</head>
<body>
    
<?php include 'Component/Header.php'; ?>

<!-- View Staff Section -->
<section class="viewpatients">
    <div class="content">
        <div class="text-content">
            <h1>View Patients</h1>
            <span>Home / Staff & Patients / <b>View Patients</b></span>
        </div>
        <div class="image-content">
            <img src="../src/26.jpg" alt="Patients Image">
        </div>
    </div>
</section>



<!-- Staff Table -->
<div class="table-container">
    <h1>Patients Details</h1>

<!-- Search Bar -->
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search by NIC, name, phone, email..." onkeyup="filterTable()">
</div>

    <table id="PatientsTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIC</th>
                <th>Reg. Date</th>
                <th>Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
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
        const table = document.getElementById("PatientsTable");
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
