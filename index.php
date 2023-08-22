<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Telefonní seznam</title>
</head>
<body>

<h2>Přidat kontakt</h2>

<form action="insert.php" method="post">
    Telefonní číslo: <input type="text" name="telefoni_cislo"><br>
    Jméno: <input type="text" name="jmeno"><br>
    Příjmení: <input type="text" name="prijmeni"><br>
    Oddělení: <input type="text" name="oddeleni"><br>
    <input type="submit" value="Přidat">
</form>

<h2>Vyhledat kontakt</h2>

<form action="index.php" method="get">
    Vyhledávání (jméno, příjmení nebo telefonní číslo): 
    <input type="text" name="query" value="<?php if(isset($_GET['query'])) echo $_GET['query']; ?>">
    <input type="submit" value="Vyhledat">
</form>
<hr>

<?php
$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : "";

if (!empty($searchQuery)) {
    $stmt = $mysqli->prepare("SELECT * FROM zamestnanci WHERE 
            jmeno LIKE ? OR 
            prijmeni LIKE ? OR 
            telefoni_cislo LIKE ?
            ORDER BY 
            CASE WHEN jmeno LIKE ? THEN 1 
                 WHEN prijmeni LIKE ? THEN 2 
                 WHEN telefoni_cislo LIKE ? THEN 3 
                 ELSE 4 END, jmeno, prijmeni");

    $searchParam = "%$searchQuery%";
    $stmt->bind_param("ssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);

    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $mysqli->query("SELECT * FROM zamestnanci");
}

if ($result->num_rows == 0 && !empty($searchQuery)) {
    echo "<p>Nenalezen žádný kontakt odpovídající vyhledávacímu dotazu.</p>";
}
?>




<h2>Seznam kontaktů</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Telefonní číslo</th>
        <th>Jméno</th>
        <th>Příjmení</th>
        <th>Oddělení</th>
        <th>Akce</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $highlight = "";
            if (!empty($searchQuery) && (stripos($row['jmeno'], $searchQuery) !== false ||
                stripos($row['prijmeni'], $searchQuery) !== false ||
                stripos($row['telefoni_cislo'], $searchQuery) !== false)) {
                    $highlight = " highlight";
            }
            
            echo "<tr class='$highlight'>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['telefoni_cislo']}</td>";
            echo "<td>{$row['jmeno']}</td>";
            echo "<td>{$row['prijmeni']}</td>";
            echo "<td>{$row['oddeleni']}</td>";
            echo "<td><a href='edit.php?id={$row['id']}'>Editovat</a> | <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Opravdu chcete smazat tento kontakt?')\">Smazat</a></td>";
            echo "</tr>";
        }
    }
    ?>
</table>


</body>
</html>
