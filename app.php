<?php
    require_once 'vendor/autoload.php';
    use App\Database;
    use Models\Campers;

    $db = new Database();
    $conn = $db -> getConnection('mysql'); //conexion con mysql
    //asiganmos una conexion activa para todos los modelos que se crearon 
    Campers :: setConn($conn);

?>