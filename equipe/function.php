<?php
   // Récupération des équipes
   $sql = "SELECT * FROM Equipe";
   $result = $pdo->query($sql);
// Connexion à la base de données
if (isset($_POST['envoyer'])) {
// Récupération des données du formulaire
$nom = $_POST["nom"];
$description = $_POST["description"];
try {
    
    // Requête SQL pour l'insertion de l'équipe dans la base de données
    $sql = "INSERT INTO Equipe (Nom, Description) VALUES (:nom, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->execute();
    echo "<script>alert(''équipe a été ajouté avec succès.)</script>L";
    header('Location: index.php');
} catch(PDOException $e) {
    echo "Erreur lors de la création de l'équipe : " . $e->getMessage();
}

    
}
  // Suppression de l'équipe
  if (isset($_POST["supprimer"])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM Equipe WHERE ID_equipe = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "<script>alert(''équipe a été supprimée avec succès.)</script>L";
    header('Location: index.php');
}

    // Modification de l'équipe
    if (isset($_POST["modifier"])) {
        $id = $_POST["id"];
        $nom = $_POST["nom"];
        $description = $_POST["description"];

        $sql = "UPDATE Equipe SET Nom = :nom, Description = :description WHERE ID_equipe = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        header('Location: index.php');
    }
?>
