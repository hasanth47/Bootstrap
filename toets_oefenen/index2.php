<?php
$conn = new PDO("mysql:host=localhost;dbname=school", "root", "");

// Haal gemiddelde cijfers per leerling op
$stmt = $conn->query("
  SELECT l.naam, ROUND(AVG(t.cijfer), 1) AS gemiddeld
  FROM leerling l
  JOIN toets t ON l.id = t.leerling_id
  GROUP BY l.id
");

$gegevens = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Gemiddelde cijfers</title>
</head>
<body>
  <h2>Gemiddelde cijfers per leerling</h2>

  <table border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>Naam</th>
      <th>Gemiddelde</th>
    </tr>

    <?php foreach ($gegevens as $rij): ?>
      <tr>
        <td><?= htmlspecialchars($rij['naam']) ?></td>
        <td><?= $rij['gemiddeld'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <br>
  <a href="index.php">⬅️ Terug naar overzicht</a>
</body>
</html>
