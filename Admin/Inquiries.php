<?php
require_once ('../Connect.php');
$data = "SELECT * FROM inquires";
$result_list = "";
$row_number = 1;
$result= mysqli_query($conp,$data);
if ($result){
     while ($result1=mysqli_fetch_assoc($result)){

        $formatted_row_number = str_pad($row_number, 2, "0", STR_PAD_LEFT);


        $result_list.="<tr>";
        $result_list .= "<td>{$formatted_row_number}</td>";
        $result_list.="<td>{$result1['inquire_id']}</td>";
        $result_list.="<td>{$result1['date']}</td>";
        $result_list.="<td>{$result1['hospital']}</td>";
        $result_list.="<td>{$result1['name']}</td>";
        $result_list.="<td>{$result1['phone_no']}</td>";
        $result_list.="<td>{$result1['email']}</td>";
        $result_list.="<td>{$result1['message']}</td>";
        $result_list.="</tr>";
        $row_number++;
     }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquires</title>
</head>
<body>
    
<?php
include 'Component/Header.php';
?>


<link rel="stylesheet" href="css/Inquiries.css">


<!-- Inquire Section -->
<section class="inquire">
    <div class="content">
        <div class="text-content">
            <h1>Inquiries</h1>
            <span>Home / <b>Inquiries</b></span>
        </div>
        <div class="image-content">
            <img src="../src/13.jpg" alt="Inquiries Image">
        </div>
    </div>
</section>


<!-- Inquiry Table -->
<div class="table-container">
    <h1>Inquiry Details</h1>

<!-- Search Bar -->
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search by name, email, phone, branch, or specialty..." onkeyup="filterTable()">
</div>

<table id = "InquiryTable">

    <thead>
        <tr>

        <th>No</th>
        <th>Inquiry ID</th>
        <th>Date</th>
        <th>Branch</th>
        <th>Name</th>
        <th>Phone No</th>
        <th>Email</th>
        <th>Message</th>
     

        </tr>
    </thead>
    <?php echo $result_list;?>
</table>
</div>

<!-- sear bar -->
<script>
    function filterTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const table = document.getElementById("InquiryTable");
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

<?php
include 'Component/Footer.php';
?>

</body>
</html>