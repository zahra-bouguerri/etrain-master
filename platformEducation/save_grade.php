<?php
include "./config/connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["quizId"]) && isset($_POST["percentageCorrect"]) && isset($_POST["userId"])) {
        $quizId = $_POST["quizId"];
        $percentageCorrect = $_POST["percentageCorrect"];
        $userId = $_POST["userId"];

        // Préparer la requête SQL pour insérer les données dans la table "grades"
        $sql = "INSERT INTO grades (student_id, quiz_id, score) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $userId, $quizId, $percentageCorrect);

        // Exécuter la requête
        if ($stmt->execute()) {
            // Envoyer une réponse JSON indiquant que l'enregistrement s'est bien déroulé
            echo json_encode(["success" => true]);
            exit;
        } else {
            // Envoyer une réponse JSON indiquant l'échec de l'enregistrement
            echo json_encode(["success" => false, "error" => "Failed to save grade"]);
            exit;
        }
    }
}
?>
