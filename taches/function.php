<?php


// Exemple d'opération sur une table (ajouter une tâche)
if (isset($_POST['add_task'])) {
   $nom = $_POST['nom'];
   $description = $_POST['description'];
   $date_echeance = $_POST['date_echeance'];
   $id_utilisateur = $_POST['id_utilisateur'];
   $id_equipe = $_POST['id_equipe'];
   $id_agenda = $_POST['id_agenda'];

   // Utiliser une requête préparée pour éviter les injections SQL
   $stmt = $conn->prepare("INSERT INTO Tache (Nom, Description, Date_d_echeance, ID_utilisateur, ID_equipe, ID_agenda) VALUES (:nom, :description, :date_echeance, :id_utilisateur, :id_equipe, :id_agenda)");
   $stmt->bindParam(':nom', $nom);
   $stmt->bindParam(':description', $description);
   $stmt->bindParam(':date_echeance', $date_echeance);
   $stmt->bindParam(':id_utilisateur', $id_utilisateur);
   $stmt->bindParam(':id_equipe', $id_equipe);
   $stmt->bindParam(':id_agenda', $id_agenda);

   if ($stmt->execute()) {
      echo "Tâche ajoutée avec succès";
   } else {
      echo "Erreur: " . $stmt->errorInfo()[2];
   }
}

// Fermer la connexion à la base de données
$conn = null;

?>