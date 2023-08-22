<?php
include 'config.php';

$id = $_POST['id'];
$telefoni_cislo = $_POST['telefoni_cislo'];
$jmeno = $_POST['jmeno'];
$prijmeni = $_POST['prijmeni'];
$oddeleni = $_POST['oddeleni'];

$stmt = $mysqli->prepare("UPDATE zamestnanci SET telefoni_cislo = ?, jmeno = ?, prijmeni = ?, oddeleni = ? WHERE id = ?");
$stmt->bind_param("ssssi", $telefoni_cislo, $jmeno, $prijmeni, $oddeleni, $id);

$stmt->execute();

header("Location: index.php");
?>
