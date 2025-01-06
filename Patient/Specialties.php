<?php
include '../Connect.php';

header('Content-Type: application/json');

if (isset($_GET['branch_id'])) {
    $branch_id = mysqli_real_escape_string($conp, $_GET['branch_id']);
    
    $query = "SELECT DISTINCT s.speciality_id, s.name 
              FROM specialities s 
              INNER JOIN staff st ON s.speciality_id = st.speciality_id 
              WHERE st.branch_id = '$branch_id' AND st.IsAvailable = 1";
    
    $result = mysqli_query($conp, $query);
    
    $specialties = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $specialties[] = $row;
    }
    
    echo json_encode($specialties);
}
?>