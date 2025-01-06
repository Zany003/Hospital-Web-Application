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
include '../Connect.php'; // Include database connection

if (isset($_POST['submit'])) {
    // Get the entered reference number
    $refNumber = $_POST['ref'];
    
    // Fetch the report details from the database
    $query = "SELECT r.report_id, r.create_at, r.patient_name, t.test_name, r.report_file 
              FROM reports r 
              JOIN tests t ON r.test_id = t.test_id 
              WHERE r.report_id = ?";
              
    $stmt = $conp->prepare($query);
    $stmt->bind_param("s", $refNumber); // Bind the reference number
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the report details
        $report = $result->fetch_assoc();
    } else {
        $error = "No report found for the provided reference number.";
    }

    $stmt->close();
}
?>

<!-- Lab Reports Head Section -->
<section class="LabReports">
    <div class="content">
        <div class="text-content">
            <h1>View Reports</h1>
            <span>Home / Laboratory Reports / <b>View Reports</b></span>
        </div>
        <div class="image-content">
            <img src="../src/19.jpg" alt="LabReports Image">
        </div>
    </div>
</section>

<section class="searchreports">
    <div class="report">
    <h1>Download Laboratory Reports</h1>
    <form action="" method="POST">


    <div class="form-row">
     <div class="form-group">
         <label for="text">Reference Number</label>
         <input type="text" id="ref" name="ref" placeholder="Enter Reference Number" required>
         </div>
</div>
     <button type="submit" name="submit">View Report</button>

     </div>
 </form>
</section>

<?php if (isset($report)): ?>
<section class="reports-details">
    <div class= "report-details">
    <h2>Report Details</h2>
    <p><strong>Reference No:</strong> <?php echo htmlspecialchars($report['report_id']); ?></p>
    <p><strong>Patient Name:</strong> <?php echo htmlspecialchars($report['patient_name']); ?></p>
    <p><strong>Report Type:</strong> <?php echo htmlspecialchars($report['test_name']); ?></p>
    <?php if ($report['report_file']): ?>
        <p><strong>Report File:</strong></p>
        <!-- Preview Button -->
        <button onclick="previewReport('<?php echo htmlspecialchars($report['report_file']); ?>')">Preview Report</button>

        <!-- Download Button -->
        <a 
           href="DownloadReports.php?file=<?php echo urlencode($report['report_file']); ?>&name=<?php echo urlencode($report['report_id'] . '_' . $report['patient_name']); ?>" 
           class="download-btn">
           Download Report
        </a>
    <?php endif; ?>
    </div>
</section>
<script>
    // Function to open the file in a new tab for preview
    function previewReport(filePath) {
        window.open('src/' + filePath, '_blank');
    }
</script>
<?php elseif (isset($error)): ?>
<p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>


<?php
include 'Component/Footer.php';
?>

</body>
</html>
