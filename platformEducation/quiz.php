<?php
include "./config/connexion.php";
include "./includes/header.php";

if (isset($_GET['quiz'])) {
    $quizId = $_GET['quiz'];
    
    // Assurez-vous que l'utilisateur est connecté avant d'accéder à la variable $_SESSION['user_id']
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    } elseif (isset($_GET['user'])) {
        $userId = $_GET['user'];
    } else {
        // Si l'utilisateur n'est pas connecté et le paramètre "user" n'est pas présent dans l'URL, affichez un message ou redirigez-le vers une page de connexion.
        echo "<script>alert('Veuillez vous connecter pour accéder au quiz.')</script>;";
        exit;
    }

    $questions = array();
    $responses = array();

    $sql_questions = "SELECT * FROM question WHERE quiz_id = $quizId";
    $result_questions = $conn->query($sql_questions);

    if ($result_questions->num_rows > 0) {
        while ($row = $result_questions->fetch_assoc()) {
            $questions[] = $row;
        }
    }

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
}
?>


<section class="blog_area single-post-area section_padding">
    <div class="container">
        <?php if (isset($questions) && isset($userId)) : ?>
        <form id="quizForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?quiz=' . $quizId . '&user=' . $userId; ?>">
            <input type="hidden" name="selected_quiz_id" id="selected_quiz_id" value="<?php echo $quizId; ?>">
            <input type="hidden" name="total_correct_responses" id="total_correct_responses" value="0">
            <?php foreach ($questions as $index => $question) :
                $question_id = $question['question_id'];
                $userSelectedResponse = false;
                $submitted_response = null;
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reponse_$question_id"])) {
                    $submitted_response = $_POST["reponse_$question_id"];
                    if (!empty($submitted_response)) {
                        $userSelectedResponse = true;
                    }
                }
            ?>
            <div class="single-post justify-content-center" <?php echo ($index > 0 ? 'style="display: none;"' : ''); ?>>
                <div class="blog_details">
                    <div>
                        <p class="excert text-right"><?php echo 'السؤال ' . ($index + 1) . ' من ' . count($questions); ?></p>
                        <div class="quote-wrapper">
                            <div class="quotes text-start">
                                <div class="text-right">
                                    <h5><?php echo $question['question_text']; ?></h5>
                                    <?php if ($question['question_img'] !== '') :
                                        $imagePath = "../HTMLversion2/" . $question['question_img'];
                                        echo '<div style="text-align: center;">';
                                        echo '<img src="' . $imagePath . '" alt=" لا توجد صورة ">';
                                        echo '</div>';
                                        echo '<br>';
                                    endif; ?>
                                    <?php foreach ($responses[$question_id] as $response) : ?>
                                        <div>
                                            <input type="radio" name="reponse_<?php echo $question_id; ?>" id="reponse_<?php echo $question_id; ?>_<?php echo $response['response_id']; ?>" value="<?php echo $response['response_id']; ?>" <?php echo ($userSelectedResponse ? 'disabled' : ''); ?> <?php echo ($submitted_response == $response['response_id'] ? 'checked' : ''); ?>>
                                            <label for="reponse_<?php echo $question_id; ?>_<?php echo $response['response_id']; ?>" style=""><?php echo $response['response_text']; ?></label>
                                            <br>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 show-correction-btn" data-question-id="<?php echo $question_id; ?>" type="button">تاكيد</button>
                            <?php if (!$userSelectedResponse && $index < count($questions) - 1) : ?>
                                <div class="detials">
                                    <button class="button rounded-0 primary-bg text-white w-100 btn_1 next-question-btn" data-question-number="<?php echo $index; ?>" type="button">السؤال القادم</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="detials">
                <button class="button rounded-0 primary-bg text-white w-100 btn_1" type="submit" name="submit_quiz">
                   استظهار النتيجة النهائية
                </button>
            </div>
        </form>
        <?php endif; ?>
    </div>
</section>
<script>
    
    const submitButton = document.querySelector('button[name="submit_quiz"]');
    const questions = document.querySelectorAll('.single-post.justify-content-center');
    let currentQuestionNumber = 0;

    submitButton.style.display = 'none';

    submitButton.addEventListener('click', function (event) {
        event.preventDefault();
        const totalCorrectResponsesField = document.getElementById('total_correct_responses');
        totalCorrectResponsesField.value = totalCorrectResponses;

        // Calculer le pourcentage de réponses correctes
        const percentageCorrect = (totalCorrectResponses / questions.length) * 100;

        // Afficher le pourcentage dans l'alerte
        alert(`لقد كانت اجابتك صحيحة  ${percentageCorrect.toFixed(2)}% .`);

        const quizId = document.getElementById('selected_quiz_id').value;
        const userId = <?php echo isset($userId) ? $userId : 'null'; ?>; // Récupérer l'ID de l'utilisateur depuis la variable PHP $userId

        // Rediriger l'utilisateur vers la page de confirmation en incluant les informations nécessaires dans l'URL
       
 
        // Enregistrer les résultats du quiz dans la base de données via une requête AJAX
        const formData = new FormData();
        formData.append('quizId', quizId);
        formData.append('percentageCorrect', percentageCorrect.toFixed(2));
        formData.append('userId', userId); // Ajouter l'ID de l'utilisateur à la requête

        fetch('save_grade.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('لقد تم الحفظ.');
            // Rediriger l'utilisateur vers la page de confirmation
            window.location.href = data.redirect;
        } else {
            console.error('حدث خطا.');
        }
    })
    .catch(error => {
        console.error('Une erreur s\'est produite lors de l\'enregistrement des résultats du quiz dans la base de données :', error);
    });
    window.location.href = `confirmation.php?quiz=${quizId}&user=${userId}&percentage_correct=${percentageCorrect.toFixed(2)}`;
    });


    const nextQuestionButtons = document.querySelectorAll('.next-question-btn');
    nextQuestionButtons.forEach(button => {
        button.addEventListener('click', function () {
            const nextQuestionNumber = currentQuestionNumber + 1;
            questions[currentQuestionNumber].style.display = 'none';
            if (nextQuestionNumber < questions.length) {
                questions[nextQuestionNumber].style.display = 'block';
                currentQuestionNumber = nextQuestionNumber;
            } else {
                document.getElementById('quizForm').submit();
            }
        });
    });

    let totalCorrectResponses = 0;

    const showCorrectionButtons = document.querySelectorAll('.show-correction-btn');
    showCorrectionButtons.forEach(button => {
    button.addEventListener('click', async function () {
            const questionId = button.getAttribute('data-question-id');
            const responses = document.querySelectorAll(`input[name="reponse_${questionId}"]`);
            let isAnyResponseCorrect = false;
            let isAnyResponseIncorrect = false;

            for (const response of responses) {
                const responseId = response.value;
                const responseLabel = document.querySelector(`label[for="reponse_${questionId}_${responseId}"]`);

                try {
                    const isCorrect = await getResponseStateFromDatabase(questionId, responseId);

                    if (isCorrect === 1) {
                        responseLabel.style.color = 'green';
                        if (response.checked) {
                            isAnyResponseCorrect = true;
                        }
                    } else {
                        responseLabel.style.color = 'red';
                        if (response.checked) {
                            isAnyResponseIncorrect = true;
                        }
                    }

                    response.disabled = true;
                } catch (error) {
                    console.error(error);
                }
            }

            button.disabled = true;

            if (!isAnyResponseIncorrect && isAnyResponseCorrect) {
            alert("احسنت اجابة صحيحة.");
            totalCorrectResponses++;
        } else if (isAnyResponseIncorrect) {
            alert("يرجى اعادة المحاولة.");
        } else {
            alert("اختر اجابة واحدة ");
        }

            if (currentQuestionNumber === questions.length - 1) {
            submitButton.style.display = 'block'; // Affiche le bouton "Soumettre le quiz" après avoir affiché la dernière réponse
        }
        });
    });

    function getResponseStateFromDatabase(questionId, responseId) {
        return new Promise(function (resolve, reject) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'get_response_state.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const isCorrect = parseInt(xhr.responseText);
                    resolve(isCorrect);
                } else {
                    reject(xhr.statusText);
                }
            };
            xhr.onerror = function () {
                reject(xhr.statusText);
            };
            xhr.send(`question_id=${questionId}&response_id=${responseId}`);
        });
    }
</script>