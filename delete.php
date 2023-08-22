<?php
include 'config.php';

$id = $_GET['id'];

$stmt = $mysqli->prepare("DELETE FROM zamestnanci WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: index.php");
?>
