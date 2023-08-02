<?php
// Assurez-vous d'inclure votre fichier de connexion à la base de données ici
// Remplacez les informations de connexion par les vôtres
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mathplatforme";

// Créez une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez si la connexion a échoué
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué: " . $conn->connect_error);
}

// Récupérez l'ID de l'année sélectionnée à partir de la requête AJAX
$year_id = $_GET['year_id'];

// Échappez l'ID de l'année pour éviter les injections SQL (utilisation recommandée de requêtes préparées, mais cela suffit pour un exemple simple)
$year_id = $conn->real_escape_string($year_id);

// Requête SQL pour sélectionner les filières en fonction de l'année sélectionnée
$sql = "SELECT field_name, field_id FROM filière WHERE year_id = $year_id";
$result = $conn->query($sql);

// Vérifiez s'il y a des résultats
if ($result->num_rows > 0) {
    // Parcourez les résultats et générez les options
    while ($row = $result->fetch_assoc()) {
        $field_name = $row['field_name'];
        $field_id = $row['field_id'];
        echo '<option value="' . $field_id . '">' . $field_name . '</option>';
    }
} else {
    echo '<option value="">Aucune filière trouvée</option>';
}

// Fermez la connexion à la base de données
$conn->close();
?>
