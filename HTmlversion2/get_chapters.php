<?php
// Inclure le fichier de configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mathplatform";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Récupérer l'ID de la filière depuis la requête GET
$branchId = $_GET['branchId'];

// Exécutez la requête SQL pour sélectionner les chapitres de la filière sélectionnée
if (!empty($branchId)) {
    $sql = "SELECT chapter_id, chapter_name FROM Chapitre WHERE filiere_id = '$branchId'";
    $result = $conn->query($sql);

    // Vérifiez s'il y a des résultats
    if ($result->num_rows > 0) {
        $chapters = array();

        // Parcourez les résultats et ajoutez les chapitres au tableau
        while ($row = $result->fetch_assoc()) {
            $chapter_id = $row['chapter_id'];
            $chapter_name = $row['chapter_name'];

            $chapter = array(
                'chapter_id' => $chapter_id,
                'chapter_name' => $chapter_name
            );

            $chapters[] = $chapter;
        }

        // Renvoyer les chapitres sous forme de JSON
        echo json_encode($chapters);
    }
}

// Fermez la connexion à la base de données
$conn->close();
?>
