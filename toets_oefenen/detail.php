<?php
$conn = new PDO("mysql:host=localhost;dbname=school", "root", "");
$id = $_GET['id'] ?? null;

if (!$id) {
  echo "Geen leerling geselecteerd.";
  exit;
}

// Haal naam van leerling op
$stmt = $conn->prepare("SELECT naam FROM leerling WHERE id = ?");
$stmt->execute([$id]);
$leerling = $stmt->fetch();

if (!$leerling) {
  echo "Leerling niet gevonden.";
  exit;
}

// Haal cijfers op
$stmt2 = $conn->prepare("SELECT vak, cijfer FROM toets WHERE leerling_id = ?");
$stmt2->execute([$id]);
$cijfers = $stmt2->fetchAll();

// Bereken gemiddelde
$stmt3 = $conn->prepare("SELECT AVG(cijfer) AS gemiddeld FROM toets WHERE leerling_id = ?");
$stmt3->execute([$id]);
$gemiddelde = $stmt3->fetchColumn();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Cijfers van <?= htmlspecialchars($leerling['naam']) ?></title>
</head>
<body>
  <h2>Cijfers van <?= htmlspecialchars($leerling['naam']) ?></h2>

  <ul>
    <?php foreach ($cijfers as $c): ?>
      <li><?= htmlspecialchars($c['vak']) ?>: <?= $c['cijfer'] ?></li>
    <?php endforeach; ?>
  </ul>

  <p><strong>Gemiddeld cijfer:</strong> <?= round($gemiddelde, 1) ?></p>

  <a href="index.php">⬅️ Terug naar overzicht</a>
</body>
</html>
