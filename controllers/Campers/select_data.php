<?php 
    require_once '../../app.php';
    
    use Models\Campers;  
    $objCampers =new Campers();
    echo json_encode($objCampers -> loadAllData()); 
?>