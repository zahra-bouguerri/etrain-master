<?php
include "./config/connexion.php";
include "./includes/header.php";
// Récupérez les informations depuis l'URL
if (isset($_GET['quiz'], $_GET['user'], $_GET['percentage_correct'])) {
    $quizId = $_GET['quiz'];
    $userId = $_GET['user'];
    $percentageCorrect = $_GET['percentage_correct'];
} else {
    // Gérer le cas où les paramètres ne sont pas définis
    // Vous pouvez afficher un message d'erreur ou rediriger l'utilisateur
    exit("Les paramètres requis ne sont pas définis.");
}


// Requête SQL pour récupérer l'ID du cours associé à ce quiz
$sql = "SELECT course_id FROM quiz WHERE quiz_id = $quizId";
$result = $conn->query($sql);

$sqlUser = "SELECT prenom FROM étudiant WHERE student_id = $userId";
$resultUser = $conn->query($sqlUser);

$userFirstName = "";

if ($resultUser->num_rows > 0) {
    $rowUser = $resultUser->fetch_assoc();
    $userFirstName = $rowUser['prenom'];
}
// Requête SQL pour récupérer le nom du quiz en fonction de son ID
$sqlQuiz = "SELECT quiz_name FROM quiz WHERE quiz_id = $quizId";
$resultQuiz = $conn->query($sqlQuiz);

$quizName = "";

if ($resultQuiz->num_rows > 0) {
    $rowQuiz = $resultQuiz->fetch_assoc();
    $quizName = $rowQuiz['quiz_name'];
}
$courseId = null;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $courseId = $row['course_id'];
}

// Maintenant, récupérons le prochain quiz du même cours
$nextQuizId = null;
$sql = "SELECT quiz_id FROM quiz WHERE course_id = $courseId AND quiz_id > $quizId ORDER BY quiz_id ASC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nextQuizId = $row['quiz_id'];
}

// Fermer la connexion à la base de données
$conn->close();
?>
<!DOCTYPE html>
<html lang="ar"  dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتيجة الاختبار</title>
    <style>
        /* Réinitialisation de la marge et du rembourrage par défaut */
        body, h1, h2, p {
            margin: 0;
            padding: 0;
        }

        /* Centrer le contenu de la page verticalement et horizontalement */
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-image: url('back2.png'); /* Ajoutez le chemin de votre image de fond */
            background-color: rgba(220, 230, 255, 0.9); 
            background-size: cover;
            background-repeat: no-repeat;
        }

        /* Styles pour la zone de confirmation */
        .confirmation-box {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9); /* Couleur de fond avec transparence */
            padding: 60px; /* Agrandir le cadre blanc */
            border-radius: 20px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3); /* Ajout de l'ombre */
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px; /* Espacement supplémentaire */
            color: #333;
        }

        p {
            font-size: 20px;
            color: #555;
            margin-bottom: 30px; /* Espacement supplémentaire */
        }

        .button {
            display: inline-block;
            padding: 12px 24px; /* Agrandir le bouton */
            font-size: 18px; /* Agrandir la police du bouton */
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<section class="confirmation-area section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="confirmation-box">
                    <?php if ($percentageCorrect >= 80) : ?>
                        <!-- Afficher le message de félicitations uniquement si le score est supérieur ou égal à 80 -->
                        <h2>تهانينا، <?php echo $userFirstName; ?> !</h2>
                        <?php else: ?>
                            <h2>  حاول مجددا  <?php echo $userFirstName; ?> !</h2>
                    <?php endif; ?>
                    <p>اسم الاختبار : <?php echo $quizName; ?></p>
                    <p>نسبة الإجابات الصحيحة : <?php echo $percentageCorrect; ?>%</p>
                    
                    <?php if ($percentageCorrect > 80 || $nextQuizId == null) : ?>
                        <a href="quiz.php?quiz=<?php echo $quizId; ?>&user=<?php echo $userId; ?>" class="button">اختبار التالي</a>
                    <?php else: ?>
                        <a href="quiz.php?quiz=<?php echo $nextQuizId; ?>&user=<?php echo $userId; ?>" class="button">إعادة الاختبار</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>