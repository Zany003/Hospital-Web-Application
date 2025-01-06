<?php
require_once ('../Connect.php');
$data = "SELECT * FROM staff";
$rest_list = "";
$result= mysqli_query($conp,$data);


if (isset($_GET['emp_no'])){
    $EMP_NO = $_GET ['emp_no'];
    $Query = "UPDATE staff SET IsAvailable = 0 WHERE emp_no = '{$EMP_NO}' LIMIT 1";
    $Result = mysqli_query($conp,$Query);
    if($Result){
        header('Location:ViewStaff.php?Member_deleted');
    
    }else{
        header('Location:ViewStaff.php?Member_NOT_deleted');
    }

    

}
?>