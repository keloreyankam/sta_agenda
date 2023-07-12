<?php
// Connexion à la base de données
include('../inc/db.php');
// Récupérer les événements depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM evenement");
$stmt->execute();
$resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

$evenements = array();

foreach($resultat as $row) {
    $evenement = array();
    $evenement['id'] = $row['id_eve'];
    $evenement['title'] = $row['nom'];
    $evenement['start'] = $row['Date_de_debut'];
    $evenement['end'] = $row['Date_de_fin'];
    array_push($evenements, $evenement);
}

echo json_encode($evenements);