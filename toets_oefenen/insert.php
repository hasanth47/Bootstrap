<?php
$conn = new PDO("mysql:host=localhost;dbname=school", "root", "");
$feedback = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $naam = trim($_POST["naam"]);
  $klas = trim($_POST["klas"]);

  if (empty($naam) || empty($klas)) {
    $feedback = "❌ Naam en klas zijn verplicht.";
  } else {
    // check of leerling al bestaat
    $check = $conn->prepare("SELECT COUNT(*) FROM leerling WHERE naam = ?");
    $check->execute([$naam]);
    if ($check->fetchColumn() > 0) {
      $feedback = "⚠️ Leerling bestaat al!";
    } else {
      $stmt = $conn->prepare("INSERT INTO leerling (naam, klas) VALUES (?, ?)");
      $stmt->execute([$naam, $klas]);
      $feedback = "✅ $naam uit klas $klas is toegevoegd.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Leerling toevoegen</title>
</head>
<body>
  <h2>Invoeren van een nieuwe leerling</h2>

  <form method="post" action="">
    Naam: <input type="text" name="naam"><br><br>
    Klas: <input type="text" name="klas"><br><br>
    <input type="submit" value="Verzenden">
  </form>

  <p><?= $feedback ?></p>

  <a href="index.php">⬅️ Terug naar overzicht</a>
</body>
</html>
