<?php
session_start();
include "./config/connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["quizId"]) && isset($_POST["percentageCorrect"]) && isset($_POST["userId"])) {
        $quizId = $_POST["quizId"];
        $percentageCorrect = $_POST["percentageCorrect"];
        $userId = $_POST["userId"];

        // Vérifier si un enregistrement avec le même quiz ID et utilisateur ID existe déjà dans la table des grades
        $checkSql = "SELECT * FROM grades WHERE student_id = ? AND quiz_id = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("ii", $userId, $quizId);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // Un enregistrement avec le même quiz ID et utilisateur ID existe déjà, ne pas enregistrer le grade
            echo json_encode(["success" => false, "error" => "Grade already recorded for this user and quiz"]);
            exit;
        } else {
            // Aucun enregistrement trouvé, procéder à l'enregistrement du grade
            $insertSql = "INSERT INTO grades (student_id, quiz_id, score) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param("iii", $userId, $quizId, $percentageCorrect);

            if ($insertStmt->execute()) {
                echo json_encode(["success" => true, "redirect" => "confirmation.php?quiz=$quizId&user=$userId&percentage_correct=$percentageCorrect"]);
                exit;
            } else {
                echo json_encode(["success" => false, "error" => "Failed to save grade"]);
                exit;
            }
        }
    }
}


?>
