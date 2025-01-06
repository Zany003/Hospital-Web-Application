<?php
require_once ('../Connect.php');
$data = "SELECT * FROM patients";
$rest_list = "";
$result= mysqli_query($conp,$data);


if (isset($_GET['nic'])){
    $NIC = $_GET ['nic'];
    $Query = "UPDATE patients SET IsAvailable = 0 WHERE nic = '{$NIC}' LIMIT 1";
    $Result = mysqli_query($conp,$Query);
    if($Result){
        header('Location:ViewPatients.php?Member_deleted');
    
    }else{
        header('Location:ViewPatients.php?Member_NOT_deleted');
    }

    

}
?>