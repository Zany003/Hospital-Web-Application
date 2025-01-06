<?php
if (isset($_GET['file']) && isset($_GET['name'])) {
    $filePath = 'src/' . $_GET['file'];
    $newFileName = $_GET['name'];

    // Check if the file exists
    if (file_exists($filePath)) {
        // Get file extension
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        
        // Set headers for file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $newFileName . '.' . $fileExtension . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        
        // Read the file and output it
        readfile($filePath);
        exit;
    } else {
        echo "Error: File not found.";
    }
} else {
    echo "Invalid request.";
}
?>