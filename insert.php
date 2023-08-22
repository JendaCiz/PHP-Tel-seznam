<?php
include 'config.php';

$telefoni_cislo = $_POST['telefoni_cislo'];
$jmeno = $_POST['jmeno'];
$prijmeni = $_POST['prijmeni'];
$oddeleni = $_POST['oddeleni'];

$stmt = $mysqli->prepare("INSERT INTO zamestnanci (telefoni_cislo, jmeno, prijmeni, oddeleni) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $telefoni_cislo, $jmeno, $prijmeni, $oddeleni);

if ($stmt->execute()) {
    echo "Nový kontakt byl úspěšně přidán!";
} else {
    echo "Chyba: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>

<br>
<a href="index.php">Zpět na hlavní stránku</a>
