<?php
// Inclure le fichier de configuration de la base de données
include "./config/connexion.php";

// Récupérer l'ID de la filière depuis la requête GET
$subchapterId = $_GET['subchapterId'];

// Exécutez la requête SQL pour sélectionner les courss de la filière sélectionnée
if (!empty($subchapterId)) {
    $sql = "SELECT * FROM cours WHERE subchapter_id = '$subchapterId'";
    $result3 = $conn->query($sql);

    // Vérifiez s'il y a des résultats
    if ($result3 && $result3->num_rows > 0) {
        $courses = array();

        // Parcourez les résultats et ajoutez les chapitres au tableau
        while ($row3 = $result3->fetch_assoc()) {
            $cours_id = $row3['course_id'];
            $cours_name = $row3['course_name'];

            $cours = array(
                'course_id' => $cours_id,
                'course_name' => $cours_name
            );
            
            $courses[] = $cours; // Change $cours to $course
        }

        // Renvoyer les course sous forme de JSON
        echo json_encode($courses);
    } else {
        // Handle the case when there are no subchapters
        $emptyResponse = array('error' => 'No courses found');
        echo json_encode($emptyResponse);
    }
}

// Fermez la connexion à la base de données
$conn->close();
?>