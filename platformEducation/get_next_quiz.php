<?php
// get_next_quiz.php
// Ce fichier doit renvoyer le prochain quiz du même cours en fonction de l'ID du quiz actuel ($quizId)

include "./config/connexion.php"; // Assurez-vous d'inclure le fichier de connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["quiz_id"])) {
    $currentQuizId = $_GET["quiz_id"];

    // Requête SQL pour récupérer le prochain quiz du même cours
    // Vous devrez remplacer "votre_table_quiz" par le nom de votre table de quiz
    // Vous devrez également définir la logique pour récupérer le prochain quiz du même cours en fonction de l'ID du quiz actuel ($currentQuizId)
    // Par exemple, vous pouvez récupérer le quiz suivant en ajoutant 1 à l'ID du quiz actuel
    $sql = "SELECT quiz_id FROM votre_table_quiz WHERE quiz_id > ? ORDER BY quiz_id ASC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $currentQuizId);
    $stmt->execute();
    $stmt->bind_result($nextQuizId);
    $stmt->fetch();

    // Vérifiez si le prochain quiz existe en effectuant une requête SQL pour vérifier s'il y a un quiz avec l'ID calculé
    // Si le prochain quiz existe, renvoyez l'ID du quiz, sinon renvoyez une réponse d'erreur
    // Vous pouvez utiliser la fonction json_encode pour renvoyer la réponse sous forme de JSON
    // Par exemple :
    if ($nextQuizId) {
        echo json_encode(["success" => true, "next_quiz_id" => $nextQuizId]);
    } else {
        echo json_encode(["success" => false, "error" => "Next quiz not available"]);
    }
}
?>
