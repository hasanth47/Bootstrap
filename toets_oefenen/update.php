<?php
$conn = new PDO("mysql:host=localhost;dbname=school", "root", "");
$id = $_GET['id'] ?? null;

// als geen id meegegeven is, terug naar index
if (!$id) {
  header("Location: index.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $naam = trim($_POST['naam']);
  $klas = trim($_POST['klas']);

  if (!empty($naam) && !empty($klas)) {
    $stmt = $conn->prepare("UPDATE leerling SET naam = ?, klas = ? WHERE id = ?");
    $stmt->execute([$naam, $klas, $id]);
    header("Location: index.php");
    exit;
  } else {
    $fout = "Naam en klas mogen niet leeg zijn.";
  }
}

// haal huidige gegevens op
$stmt = $conn->prepare("SELECT * FROM leerling WHERE id = ?");
$stmt->execute([$id]);
$leerling = $stmt->fetch();

if (!$leerling) {
  echo "Leerling niet gevonden.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Leerling bijwerken</title>
</head>
<body>
  <h2>Leerlinggegevens aanpassen</h2>

  <form method="post">
    Naam: <input type="text" name="naam" value="<?= htmlspecialchars($leerling['naam']) ?>"><br><br>
    Klas: <input type="text" name="klas" value="<?= htmlspecialchars($leerling['klas']) ?>"><br><br>
    <input type="submit" value="Opslaan">
  </form>

  <?php if (isset($fout)) echo "<p style='color:red;'>$fout</p>"; ?>

  <a href="index.php">⬅️ Terug naar overzicht</a>
</body>
</html>
