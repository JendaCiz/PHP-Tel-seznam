<?php
include 'config.php';

$id = $_GET['id'];

$stmt = $mysqli->prepare("SELECT * FROM zamestnanci WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
?>

<h2>Upravit kontakt</h2>

<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    Telefonní číslo: <input type="text" name="telefoni_cislo" value="<?php echo $row['telefoni_cislo']; ?>"><br>
    Jméno: <input type="text" name="jmeno" value="<?php echo $row['jmeno']; ?>"><br>
    Příjmení: <input type="text" name="prijmeni" value="<?php echo $row['prijmeni']; ?>"><br>
    Oddělení: <input type="text" name="oddeleni" value="<?php echo $row['oddeleni']; ?>"><br>
    <input type="submit" value="Upravit">
</form>
