<?php
// Inclure le fichier de configuration de la base de données
include "./config/connexion.php";

// Récupérer l'ID de la filière depuis la requête GET
$chapitreId = $_GET['chapitreId'];

// Exécutez la requête SQL pour sélectionner les chapitres de la filière sélectionnée
if (!empty($chapitreId)) {
    $sql = "SELECT * FROM sous_chapitre WHERE chapter_id = '$chapitreId'";
    $result2 = $conn->query($sql);

    // Vérifiez s'il y a des résultats
    if ($result2 && $result2->num_rows > 0) {
        $subchapters = array();

        // Parcourez les résultats et ajoutez les chapitres au tableau
        while ($row2 = $result2->fetch_assoc()) {
            $subchapter_id = $row2['subchapter_id'];
            $subchapter_name = $row2['subchapter_name'];

            $subchapter = array(
                'subchapter_id' => $subchapter_id,
                'subchapter_name' => $subchapter_name
            );

            $subchapters[] = $subchapter;
        }

        // Renvoyer les chapitres sous forme de JSON
        echo json_encode($subchapters);
    } else {
        // Handle the case when there are no subchapters
        $emptyResponse = array('error' => 'No subchapters found');
        echo json_encode($emptyResponse);
    }
}

// Fermez la connexion à la base de données
$conn->close();
?>