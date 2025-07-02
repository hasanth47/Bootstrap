<?php
// verbinding maken met de database
$conn = new PDO("mysql:host=localhost;dbname=school", "root", "");

// haal alle leerlingen op
$stmt = $conn->query("SELECT * FROM leerling");
$leerlingen = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Toets resultaten</title>
</head>
<body>
  <h2>Toets resultaten</h2>

  <table border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>Naam</th>
      <th>Klas</th>
      <th>Cijfers</th>
      <th>Update</th>
      <th>Verwijder</th>
    </tr>

    <?php foreach($leerlingen as $leerling): ?>
      <tr>
        <td><?= htmlspecialchars($leerling['naam']) ?></td>
        <td><?= htmlspecialchars($leerling['klas']) ?></td>
        <td><a href="detail.php?id=<?= $leerling['id'] ?>">cijfers</a></td>
        <td><a href="update.php?id=<?= $leerling['id'] ?>">update</a></td>
        <td><a href="delete.php?id=<?= $leerling['id'] ?>" onclick="return confirm('Weet je zeker dat je deze leerling wilt verwijderen?')">verwijder</a></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <p>Aantal leerlingen is <?= count($leerlingen); ?></p>

  <br>
  <a href="insert.php">➕ Leerling toevoegen</a><br>
  <a href="index2.php">📊 Gemiddelden bekijken</a>
</body>
</html>
