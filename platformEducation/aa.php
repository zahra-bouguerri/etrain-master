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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_quiz'])) {
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

}

?>
                </div>
                
                    <div class="single-post justify-content-center ">
                        <div class="blog_details">
                      <?php  $questionNumber=0?>;
                      <p class="excert text-right"><?php echo 'السؤال ' . ($questionNumber + 1) . ' من ' . count($questions) ; ?></p>
                            <div class="quote-wrapper">
                            <h3 class="text-center">تقويم <?php echo $quiz_info['quiz_name']; ?></h3>
                            <div class="text-right">
                                    <?php foreach ($questions as $question) : ?>
                                        </br>
                                        <h5><?php echo $question['question_text']; ?></h5>
                                        <?php if ($question['question_img'] !== '') : 
                                            $imagePath = "../HTMLversion2/" . $question['question_img'];?>
                                       <!-- Display the question image if available -->
                                     <?php
                                      echo '<div style="text-align: center;">';
                                       echo '<img src="' . $imagePath . '" alt="Question Image">';
                                      echo '</div>';?>
                              <?php endif; ?>
                                        <?php foreach ($responses[$question['question_id']] as $response) : ?>
                                            <div>
                                                <input type="checkbox" name="reponse_<?php echo $question['question_id']; ?>[]" value="<?php echo $response['response_id']; ?>">
                                                <label><?php echo $response['response_text']; ?></label>
                                        </br>
                                            </div>
                                        <?php endforeach; ?>
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
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chapitreList = document.querySelectorAll('.chapitreList');
        const miniChapitreList = document.querySelectorAll('.miniChapitre');
        const listes = document.querySelectorAll('.listes');
        const bccoursList = document.querySelectorAll('.bccours');
        const quizzes = document.querySelectorAll('.quizzes');

 

        chapitreList.forEach(function (chapitre) {
            chapitre.addEventListener('click', function () {
                const chapterId = this.id.split('_')[1];

                miniChapitreList.forEach(function (miniChapitre) {
                    if (miniChapitre.id === 'miniChapitre_' + chapterId) {
                        miniChapitre.classList.toggle('show');
                    } else {
                        miniChapitre.classList.remove('show');
                    }
                });
            });
        });

        listes.forEach(function (liste) {
            liste.addEventListener('click', function (e) {
                e.stopPropagation();
                const subChapterId = this.id.split('_')[1];
                const bccours = document.getElementById('bccours_' + subChapterId);
                bccours.classList.toggle('show');
            });
        });

        var widgetTitle = document.querySelector('.widget_title');

        widgetTitle.addEventListener('click', function () {
            this.classList.toggle('open');
        });

        // Get the elements
        const videoElement = document.getElementById('cc');
        const singlePostElement = document.querySelector('.posts-list');
        const vidio = document.querySelector('.vidio-list');

        // Add click event listener to the video element
        videoElement.addEventListener('click', function () {
            // Hide the single post element
            singlePostElement.style.display = 'none';
            // Show the vidio post element
            vidio.style.display = 'block';
        });
    });
        // Get the elements
        const videoElement = document.getElementById('cc');
    const singlePostElement = document.querySelector('.posts-list');
    const vidio = document.querySelector('.vidio-list');

    // Add click event listener to the video element
    videoElement.addEventListener('click', function () {
      // Hide the single post element
      singlePostElement.style.display = 'none';
      // Show the vidio post element
      vidio.style.display = 'block';
    });

    // Add click event listener to course items
    const courseItems = document.querySelectorAll('.courseItem');
    courseItems.forEach(function (courseItem) {
      courseItem.addEventListener('click', function (e) {
        e.stopPropagation();
        const courseId = this.id.split('_')[1];
        const quizzes = document.getElementById('quizzes_' + courseId);
        quizzes.classList.toggle('show');
      });
    });

</script>
<script>
  // Function to update the URL with the selected id
  function updateURL(selectedId, type) {
    const url = new URL(window.location.href);
    url.searchParams.set(type, selectedId);
    history.replaceState(null, '', url);
  }

  // Event listeners for chapitre, souschapitre, cours, and quiz
  document.querySelectorAll('.chapitreList').forEach((element) => {
    element.addEventListener('click', () => {
      const chapitreId = element.id.split('_')[1];
      updateURL(chapitreId, 'chapitre');
    });
  });

  document.querySelectorAll('.listes').forEach((element) => {
    element.addEventListener('click', () => {
      const souschapitreId = element.id.split('_')[1];
      updateURL(souschapitreId, 'souschapitre');
    });
  });

  document.querySelectorAll('.courseItem').forEach((element) => {
    element.addEventListener('click', () => {
      const coursId = element.id.split('_')[1];
      updateURL(coursId, 'cours');
    });
  });

  document.querySelectorAll('.d-flex').forEach((element) => {
    if (element.id.startsWith('quiz_')) {
      element.addEventListener('click', () => {
        const quizId = element.id.split('_')[1];
        updateURL(quizId, 'quiz');
      });
    }
  });
</script>
</script>



<?php include "./includes/footer.php"?>