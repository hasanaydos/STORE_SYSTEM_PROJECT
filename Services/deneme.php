<?php

if (isset($_POST["senderNanme"]) && 
    isset($_POST["receiverName"]) && 
    isset($_POST["weight"]) && 
    isset($_POST["volume"]) && 
    isset($_POST["breakable"]) && 
    isset($_POST["cargoDetail"]) && 
    isset($_POST["sCity"]) && 
    isset($_POST["sCountry"]) && 
    isset($_POST["sDetail"]) &&  
    isset($_POST["dCity"]) && 
    isset($_POST["dCountry"]) && 
    isset($_POST["dDetail"])) {
    
    echo 'başarılı...';
} else {
    echo 'başarı başaracağım diye başlayanın...';
}


?>

