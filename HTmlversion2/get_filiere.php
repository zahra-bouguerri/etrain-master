<?php
// Inclure le fichier de configuration de la base de données
include "./config/connexion.php";

// Récupérer l'ID de la filière depuis la requête GET
$year = $_GET['year'];

// Exécutez la requête SQL pour sélectionner les chapitres de la filière sélectionnée
if (!empty($year)) {
    $sql = "SELECT * FROM filière WHERE year_id = '$year'";
    $result = $conn->query($sql);

    // Vérifiez s'il y a des résultats
    if ($result->num_rows > 0) {
        $branchs = array();

        // Parcourez les résultats et ajoutez les filiere au tableau
        while ($row = $result->fetch_assoc()) {
            $branch_id = $row['field_id'];
            $branch_name = $row['field_name'];

            $branch = array(
                'field_id' => $branch_id,
                'field_name' => $branch_name
            );

            $branchs[] = $branch;
        }

        // Renvoyer les chapitres sous forme de JSON
        echo json_encode($branchs);
    }
}

// Fermez la connexion à la base de données
$conn->close();
?>
