<?php include "./config/connexion.php";
include "./includes/header.php";?>

    <!-- breadcrumb start-->
    <!-- ================ contact section start ================= -->

    <section class="blog_area single-post-area section_padding">
        <div class="container">
            <div class="row">
             <form id="quizForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="selected_quiz_id" id="selected_quiz_id" value="<?php echo $quiz_id; ?>">                 
<?php 
// Check if the quiz ID is present in the URL
if (isset($_GET['quiz'])) {
    $quizId = $_GET['quiz'];
    $userId = $_GET['user'];
} else {
    // If quiz ID is not present in the URL, you can set a default value or handle the error
    $quizId = 0; // For example, setting it to 0 as a default value
}
// Récupérer les questions
$questions = array();
$sql_questions = "SELECT * FROM question WHERE quiz_id = $quizId";
$result_questions = $conn->query($sql_questions);
if ($result_questions->num_rows > 0) {
    while ($row = $result_questions->fetch_assoc()) {
        $questions[] = $row;
    }
}

// Récupérer les réponses pour chaque question
$responses = array();
foreach ($questions as $question) {
    $question_id = $question['question_id'];
    $sql_responses = "SELECT * FROM response WHERE question_id = $question_id";
    $result_responses = $conn->query($sql_responses);
    if ($result_responses->num_rows > 0) {
        while ($row = $result_responses->fetch_assoc()) {
            $responses[$question_id][] = $row;
        }
    }
}

// Récupérer les informations du quiz
$quiz_info = array();
$sql_quiz_info = "SELECT * FROM quiz WHERE quiz_id = $quizId";
$result_quiz_info = $conn->query($sql_quiz_info);
if ($result_quiz_info->num_rows > 0) {
    $quiz_info = $result_quiz_info->fetch_assoc();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nom du test soumis par le formulaire
    $quiz_name = $_POST["quiz_name"];

    // Insérer le nom du test dans la base de données
    $sql_update_quiz_name = "UPDATE quiz SET quiz_name = '$quiz_name' WHERE quiz_id = $quizId";
    if ($conn->query($sql_update_quiz_name) === TRUE) {
        // Le nom du test a été inséré avec succès
    } else {
        echo "Erreur lors de l'insertion du nom du test dans la base de données: " . $conn->error;
    }
}

if (isset($_POST['submit_quiz'])) {
    // Le formulaire a été soumis et le bouton "السؤال القادم" a été cliqué

    // Récupérer les réponses soumises par l'utilisateur
    foreach ($questions as $question) {
        $question_id = $question['question_id'];
        if (isset($_POST["reponse_$question_id"])) {
            // L'utilisateur a coché des réponses pour cette question
            $submitted_responses = $_POST["reponse_$question_id"];
            // Traitez les réponses soumises par l'utilisateur ici
            // ...
        }
    }
    $submitted_quiz_id = $_POST['selected_quiz_id'];
}
?>
                </div>
                
                    <div class="single-post justify-content-center ">
                        <div class="blog_details">
                        
                        <?php foreach ($questions as $index => $question) : ?>
    <!-- Display each question and its responses -->
    <?php $question_id = $question['question_id']; ?>
    <div class="single-post justify-content-center">
        <div class="blog_details">
            <form method="post">
            <p class="excert text-right"><?php echo 'السؤال ' . ($index + 1) . ' من ' . count($questions); ?></p>
            <div class="quote-wrapper">
            <div  class="quotes text-start">
            <div class="text-right">
                <h5><?php echo $question['question_text']; ?></h5>
                <?php if ($question['question_img'] !== '') :
                    $imagePath = "../HTMLversion2/" . $question['question_img'];
                    // Display the question image if available
                    echo '<div style="text-align: center;">';
                    echo '<img src="' . $imagePath . '" alt="Question Image">';
                    echo '</div>';
                endif; ?>
                <?php foreach ($responses[$question_id] as $response) : ?>
                    <div>
                        <input type="checkbox" name="reponse_<?php echo $question_id; ?>[]" value="<?php echo $response['response_id']; ?>">
                        <label><?php echo $response['response_text']; ?></label>
                        <br>
                    </div>
                <?php endforeach; ?>
                </div>
                </div>
                <!-- Add the "Submit" button for each question -->
                <div class="detials">
                    <button class="button rounded-0 primary-bg text-white w-100 btn_1" type="submit" name="submit_quiz">السؤال القادم</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add a hidden input field to store the current question number -->
    <input type="hidden" name="question_number" value="<?php echo $questionNumber; ?>">
<?php endforeach; ?>
                                        </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                    <div class="detials">
    <button class="button rounded-0 primary-bg text-white w-100 btn_1" type="submit" name="submit_quiz">السؤال القادم</button>
</div>
                    </div>
                </form>
                </div>
            </div>
         
            <!--vidio div-->

            <div class="col-lg-8 vidio-list" style="display: none;">
                <div class="single-post ">
                    <div class="blog_details">
                        <h2>vidio</h2>
                        <p class="excert"></p>
                        <div class="quote-wrapper ">
                            <p class="text-center">السؤال </p>
                            <div class="quotes text-start">
                                هل تحب زهرة
                            </div>
                        </div>
                    </div>
                                        </form>
                </div>
            </div>

        </div>
    </div>

<?php include "./includes/footer.php"?>