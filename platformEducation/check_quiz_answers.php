<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["totalCorrectResponses"]) && isset($_POST["totalQuestions"])) {
        $totalCorrectResponses = (int)$_POST["totalCorrectResponses"];
        $totalQuestions = (int)$_POST["totalQuestions"];

        // Stocker les résultats du quiz dans la session
        $_SESSION["quiz_results"] = [
            "totalCorrectResponses" => $totalCorrectResponses,
            "totalQuestions" => $totalQuestions
        ];

        // Envoyer une réponse JSON indiquant que l'enregistrement s'est bien déroulé
        echo json_encode(["success" => true]);
        exit;
    }
}

// En cas d'erreur, envoyer une réponse JSON indiquant l'échec de l'enregistrement
echo json_encode(["success" => false]);