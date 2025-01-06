<?php
include '../Connect.php';

if (isset($_POST['submit'])) {

    $Ref = mysqli_real_escape_string($conp, $_POST['ref']);
    $Type = mysqli_real_escape_string($conp, $_POST['reporttype']);
    $Name = mysqli_real_escape_string($conp, $_POST['name']);
    $Upload = mysqli_real_escape_string($conp, $_POST['upload']);

    // Check if ref already exists
    $checkNICQuery = "SELECT * FROM reports WHERE report_id = ? LIMIT 1";
    $stmt = mysqli_prepare($conp, $checkNICQuery);
    mysqli_stmt_bind_param($stmt, 's', $Ref);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($checkResult) > 0) {
        // REF already exists
        echo "<script>alert('Reference Number Already Exists! Please Use a Different Reference Number.');</script>";
        echo "<script>window.location.href='LabReports.php';</script>";
    } else {

    // Insert reports into database
    $query = "INSERT INTO reports (report_id, test_id, patient_name, report_file) 
              VALUES ('$Ref', '$Type', '$Name', '$Upload')";

    if (mysqli_query($conp, $query)) {
        echo "<script>alert('Report Uploaded Successfully!'); window.location.href='LabReports.php';</script>";
    } else {
        echo "<script>alert('Error Uploading Report. Please try again.'); window.location.href='LabReports.php';</script>";
    }
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Reports</title>
    <link rel="stylesheet" href="css/LabReports.css">
</head>
<body>
    


<?php
include 'Component/Header.php';
?>

<!-- Lab Reports  head Section -->
<section class="LabReports">
    <div class="content">
        <div class="text-content">
            <h1>Upload Reports</h1>
            <span>Home / Laboratory Reports / <b>Upload Reports</b></span>
        </div>
        <div class="image-content">
            <img src="../src/19.jpg" alt=" LabReports Image">
        </div>
    </div>
</section>


<section class="Uploadreports">   
    <form action="" method="POST">
        <div class="upload">         
            <div class="form-row">
                <div class = "form-group">
                <label for="text">Reference Number</label>
                <input type="text" id="ref" name="ref" placeholder="Enter Reference Number" required>
                </div>
            </div>

        <div class="form-row">
            <div class="form-group">
                    <label for="reporttype">Select Report Type</label>
                    <select id="reporttype" name="reporttype" required>
                        <option value="" disabled selected>Select Report Type</option>
                        <?php
                            $query = "SELECT test_id, test_name FROM tests";
                            $result = mysqli_query($conp, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['test_id'] . "'>" . $row['test_name'] . "</option>";
                        }
                        ?>
                    </select>
            </div>
            </div>

        <div class="form-row">
            <div class = "form-group">
                <label for="text">Patient's Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Patient's Name" required>
            </div>
        </div>

        <div class="form-row">
            <div class = "form-group">
                <label for="text">Choose Patient's Report</label>
                <input type="file" id="upload" name="upload" placeholder="Upload Patient's Reports" required>
            </div>
            </div>

        
            <button type="submit" name="submit">Upload</button>
        </div>
    </form>
</section>

<?php
include 'Component/Footer.php';
?>


</body>
</html>