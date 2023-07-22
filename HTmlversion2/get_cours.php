<?php
// Inclure le fichier de configuration de la base de données
include "./config/connexion.php";

// Récupérer l'ID de la filière depuis la requête GET
$coursId = $_GET['coursId'];

// Exécutez la requête SQL pour sélectionner les courss de la filière sélectionnée
if (!empty($coursId)) {
    $sql = "SELECT * FROM cours WHERE course_id = '$coursId'";
    $result3 = $conn->query($sql);

    // Vérifiez s'il y a des résultats
    if ($result3 && $result3->num_rows > 0) {
        $courses = array();

        // Parcourez les résultats et ajoutez les chapitres au tableau
        while ($row3 = $result3->fetch_assoc()) {
            $course_id = $row3['course_id'];
            $course_name = $row3['course_name'];

            $cours = array(
                'course_id' => $course_id,
                'course_name' => $course_name
            );

            $courses[] = $course;
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