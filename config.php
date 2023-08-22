<?php
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "moje_nova_databaze"; 

// Vytvoření připojení
$mysqli= new mysqli($servername, $username, $password, $dbname);

// Kontrola připojení
if ($mysqli->connect_error) {
    die("Připojení selhalo: " . $mysqli->connect_error);
}
?>
