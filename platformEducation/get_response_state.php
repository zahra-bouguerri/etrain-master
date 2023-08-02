<?php
// Inclut les fichiers de configuration et de connexion à la base de données
include "./config/connexion.php";

if (isset($_POST['question_id']) && isset($_POST['response_id'])) {
    $questionId = $_POST['question_id'];
    $responseId = $_POST['response_id'];

    // Récupère l'état de la réponse dans la base de données en utilisant l'ID de la question et de la réponse
    $sql = "SELECT is_correct FROM response WHERE question_id = $questionId AND response_id = $responseId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $isCorrect = $row['is_correct'];

        // Retourne l'état de la réponse (1 pour correcte, 0 pour incorrecte)
        echo $isCorrect;
    } else {
        // Si la réponse n'est pas trouvée, considérer qu'elle est incorrecte
        echo "0";
    }
} else {
    // Si les paramètres 'question_id' et 'response_id' ne sont pas définis, retourne une valeur par défaut (0 pour incorrecte)
    echo "0";
}
?>
