<?php
function getDatabaseConnection(){
    $servername="sql104.infinityfree.com";
    $username="if0_37382946";
    $password="b78IooFTrFy";
    $database="if0_37382946_beststoredb";
    $connection = new mysqli($servername,$username,$password,$database);
    if($connection->connect_error){
        die("Error failed to connect MySQL: ".$connection->connect_error);

    }

    return $connection;

}
?>