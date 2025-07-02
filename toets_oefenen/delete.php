<?php
$conn = new PDO("mysql:host=localhost;dbname=school", "root", "");
$id = $_GET['id'] ?? null;

// controleer of id meegegeven is
if ($id) {
  // eerst cijfers verwijderen
  $conn->prepare("DELETE FROM toets WHERE leerling_id = ?")->execute([$id]);
  // daarna leerling verwijderen
  $conn->prepare("DELETE FROM leerling WHERE id = ?")->execute([$id]);
}

// terug naar indexpagina
header("Location: index.php");
exit;
?>
