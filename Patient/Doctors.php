<?php
include '../Connect.php';

header('Content-Type: application/json');

if (isset($_GET['speciality_id']) && isset($_GET['branch_id'])) {
    $speciality_id = mysqli_real_escape_string($conp, $_GET['speciality_id']);
    $branch_id = mysqli_real_escape_string($conp, $_GET['branch_id']);
    
    $query = "SELECT emp_no, name 
              FROM staff 
              WHERE speciality_id = '$speciality_id' 
              AND branch_id = '$branch_id' 
              AND IsAvailable = 1";
    
    $result = mysqli_query($conp, $query);
    
    $doctors = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $doctors[] = $row;
    }
    
    echo json_encode($doctors);
}
?>