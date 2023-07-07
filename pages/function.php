<?php
// Ajouter un événement à la base de données
include('../inc/db.php');
if (isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $description = $_POST['description'];

    $sql = "INSERT INTO evenement (Nom, Description, Date_de_debut, Date_de_fin) VALUES (:titre, :description, :date_debut, :date_fin)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':date_debut', $date_debut);
    $stmt->bindParam(':date_fin', $date_fin);
    $stmt->bindParam(':description', $description);
    if ($stmt->execute()) {
        echo 'Événement ajouté.';
    } else {
        echo 'Erreur d\'ajout d\'événement.';
    }
}


// Modifier un événement dans la base de données
if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $description = $_POST['descr$description'];

    $sql = "UPDATE evenement SET Nom =:titre, date_de_debut=:date_debut, date_de_fin=:date_fin, description = :description WHERE id_eve=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':date_debut', $date_debut);
    $stmt->bindParam(':date_fin', $date_fin);
    $stmt->bindParam(':description', $description);
    if ($stmt->execute()) {
        echo 'Événement modifié.';
    } else {
        echo 'Erreur de modification d\'événement.';
    }
}
// Supprimer l'événement de la base de données
if (isset($_POST['supprimer'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM evenements WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        echo 'Événement supprimé.';
    } else {
        echo 'Erreur de suppression d\'événement.';
    }
}

?>