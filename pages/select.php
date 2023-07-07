<?php
// Connexion à la base de données
include('../inc/db.php');
// Récupérer les événements depuis la base de données
$sql = "SELECT * FROM evenement";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retourner les événements au format JSON
header('Content-Type: application/json');
echo json_encode($evenements);
?>
