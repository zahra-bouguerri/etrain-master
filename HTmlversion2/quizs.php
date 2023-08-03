<?php
include "./includes/header.php";

// Create the "upload/" directory if it doesn't exist
$targetDir = "upload/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true); // Set appropriate permissions, e.g., 0755
}

// Fonction pour insérer le quiz dans la base de données
function ajouterQuiz($quizName, $courseId, $questions, $img, $allChoices, $correctAnswers)
{
    global $conn;

    $checkQuizQuery = "SELECT quiz_id FROM quiz WHERE quiz_name = '$quizName' AND course_id = $courseId";
    $result = mysqli_query($conn, $checkQuizQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert(اسم التقويم موجود سابقا');</script>";
        return; // Exit the function if the quiz already exists
    }

    $insertQuizQuery = "INSERT INTO quiz (quiz_name, course_id) VALUES ('$quizName', $courseId)";
    mysqli_query($conn, $insertQuizQuery);
    $quizId = mysqli_insert_id($conn);

    for ($i = 0; $i < count($questions); $i++) {
        $questionText = $questions[$i];

  // Upload the image to a folder on the server
  $targetDir = "upload/"; // Change the folder path as per your requirement
  $targetFile = $targetDir . basename($_FILES["question_img"]["name"][$i]);
  move_uploaded_file($_FILES["question_img"]["tmp_name"][$i], $targetFile);
 


        $checkQuestionQuery = "SELECT question_id FROM question WHERE question_text = '$questionText' AND quiz_id = $quizId";
        $result = mysqli_query($conn, $checkQuestionQuery);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('azer.');</script>";
            return; // Exit the function if the quiz already exists
        }
        // Insert question data into the database
        $insertQuestionQuery = "INSERT INTO question (question_text, question_img, quiz_id) VALUES ('$questionText', '$targetFile', $quizId)";
        mysqli_query($conn, $insertQuestionQuery);
        $questionId = mysqli_insert_id($conn);

        $questionChoices = $allChoices[$i];
        $correctChoiceIndex = $correctAnswers[$i];
        for ($j = 0; $j < count($questionChoices); $j++) {
            $choiceText = $questionChoices[$j];
            $choiceIsCorrect = in_array($j, $correctChoiceIndex) ? 1 : 0; // Vérifier si la case à cocher avec la valeur $j est cochée
            if (!empty($choiceText)) {
            $insertResponseQuery = "INSERT INTO response (response_text, question_id, is_correct) VALUES ('$choiceText', $questionId, $choiceIsCorrect)";
            mysqli_query($conn, $insertResponseQuery);}
        }   
    }

    echo "<script>alert('تمت الاضافة.')</script>";
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ajouter_quiz"])) {
    // Récupérer les données soumises par l'utilisateur
    $quizName = $_POST["quiz_name"];
    $courseId = $_POST["course_id"];
    $questions = $_POST["question_text"];
    $img = isset($_FILES["question_img"]) ? $_FILES["question_img"]["tmp_name"] : [];
    $choices = $_POST["choice_text"];

    // Le tableau des réponses correctes
    $correctAnswers = array();

    foreach ($_POST["is_correct"] as $questionIndex => $correctAnswer) {
        foreach ($correctAnswer as $choiceIndex) {
            $correctAnswers[$questionIndex][] = intval($choiceIndex);
        }
    }

    // Appeler la fonction pour ajouter le quiz
    ajouterQuiz($quizName, $courseId, $questions, $img, $choices, $correctAnswers);
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Mettez ici les balises meta, title, CSS, etc. -->
</head>
<style>
    .radio-container {
    display: flex; /* Utiliser flexbox pour aligner les cercles de radio et les zones de saisie horizontalement */
    align-items: center; /* Aligner les éléments verticalement au centre */
    margin-bottom: 10px;
}

.radio-container input[type="radio"] {
    margin-right: 5px; /* Ajouter un espacement entre le cercle de radio et la zone de saisie */
}

.response-container {
    display: flex; /* Utiliser flexbox pour aligner les étiquettes de cercle de radio et les zones de saisie horizontalement */
    align-items: center; /* Aligner les éléments verticalement au centre */
    margin-bottom: 10px;
}

.response-container input[type="text"] {
    width: 1100px; /* Largeur initiale */
    margin-right: 5px; /* Ajouter un espacement entre l'étiquette de cercle de radio et la zone de saisie */
}

.response-container label {
    display: block;
}

    .response-container {
        margin-bottom: 10px;
    }

    .response-container input[type="text"] {
        width: 1100px; /* Largeur initiale */
    }

    .response-container label {
        display: block;
    }

    

    .supprimer-reponse {
        margin-top: 5px;
    }
</style>
<body>
<div class="responsive-table">
    <div id="question-container">
        <div class="content w-full">
            <div class="projects p-20 bg-white rad-10 m-20">
                <h2 class="mt-0 mb-20">اضافة تقويم جديد</h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="text" class="input-field" name="quiz_name" placeholder="عنوان التقويم">
                    <select class="select-field" name="course_id">
                        <option value="" disabled selected>اختر الدرس </option>
                        <?php
                        $sql = "SELECT course_name, course_id FROM cours";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $coursName = $row['course_name'];
                                $coursId = $row['course_id'];
                                echo '<option value="' . $coursId . '">' . $coursName . '</option>';
                            }
                        } else {
                            echo '<option value="">لا يوجد درس</option>';
                        }
                        ?>
                    </select>
                    <div id="main-container">
                        <!-- Code pour afficher le premier champ de question -->
                        <div id="question-container-1">
                            <h2>السؤال 1</h2>
                            <textarea class="textarea-field" name="question_text[0]" placeholder="نص السؤال"></textarea>
                            <h2>الصورة</h2>
                            <input type="file" name="question_img[]" id="file" ><br>
                            <h2>الاختيارات</h2>
                            <div class="input-container">
                                <label class="radio-container">
                                    <input type="radio" name="is_correct[0][]" value="0">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" class="input-field" name="choice_text[0][]" placeholder="اختيار">
                                <!-- Bouton "Supprimer réponse" pour supprimer cette réponse -->
                                
                            </div>
                            <div class="input-container">
                                <label class="radio-container">
                                    <input type="radio" name="is_correct[0][]" value="1">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" class="input-field" name="choice_text[0][]" placeholder="اختيار">
                                <!-- Bouton "Supprimer réponse" pour supprimer cette réponse -->
                             
                            </div>
                            <div class="input-container">
                                <label class="radio-container">
                                    <input type="radio" name="is_correct[0][]" value="2">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" class="input-field" name="choice_text[0][]" placeholder="اختيار">
                                <!-- Bouton "Supprimer réponse" pour supprimer cette réponse -->
                               
                            </div>
                            <!-- Bouton "Ajouter question" pour ajouter une nouvelle question -->
                            <button type="button" class="ajouter-question cc">اضافة سؤال </button>
                            <!-- Add a button for inserting the math keyboard symbol -->
                            <button type="button" class="insert-math-symbol cc"> اضافة رمز </button>
                        </div>
                       
                    </div>
                    <button type="submit" name="ajouter_quiz">إضافة الاختبار</button>
                </form>
                <div class="keyboard">
                <button onclick="insertSymbol('-')">-</button>
                <button onclick="insertSymbol('+')">+</button>
                <button onclick="insertSymbol('−')">−</button>
                <button onclick="insertSymbol('×')">×</button>
                <button onclick="insertSymbol('÷')">÷</button>
                <button onclick="insertSymbol('=')">=</button>
                <button onclick="insertSymbol('±')">±</button>
                <button onclick="insertSymbol('≠')">≠</button>
                <button onclick="insertSymbol('(')">(</button>
                <button onclick="insertSymbol(')')">)</button>
                <button onclick="insertSymbol('<')">〈</button>
                <button onclick="insertSymbol('>')">〉</button>
                <button onclick="insertSymbol('≤')">≤</button>
                <button onclick="insertSymbol('≥')">≥</button>
                <button onclick="insertSymbol('/')">⁄</button>
                <button onclick="insertSymbol('√')">√</button>
                <button onclick="insertSymbol('∛')">∛</button>
                <button onclick="insertSymbol('∜')">∜</button>
                <button onclick="insertSymbol('∞')">∞</button>
                <button onclick="insertSymbol('ℵ')">ℵ</button>
                <button onclick="insertSymbol('ƒ')">ƒ</button>
                <button onclick="insertSymbol('′')">′</button>
                <button onclick="insertSymbol('″')">″</button>
                <button onclick="insertSymbol('‴')">‴</button>
                <button onclick="insertSymbol('⋅')">⋅</button>
                <button onclick="insertSymbol('〈')">〈</button>
                <button onclick="insertSymbol('〉')">〉</button>
                <button onclick="insertSymbol('⌈')">⌈</button>
                <button onclick="insertSymbol('⌉')">⌉</button>
                <button onclick="insertSymbol('⌊')">⌊</button>
                <button onclick="insertSymbol('⌋')">⌋</button>
                <button onclick="insertSymbol('⊕')">⊕</button>
                <button onclick="insertSymbol('⊗')">⊗</button>
                <button onclick="insertSymbol('⁰')">⁰</button>
                <button onclick="insertSymbol('¹')">¹</button>
                <button onclick="insertSymbol('²')">²</button>
                <button onclick="insertSymbol('³')">³</button>
                <button onclick="insertSymbol('⁴')">⁴</button>
                <button onclick="insertSymbol('⁵')">⁵</button>
                <button onclick="insertSymbol('⁶')">⁶</button>
                <button onclick="insertSymbol('⁷')">⁷</button>
                <button onclick="insertSymbol('⁸')">⁸</button>
                <button onclick="insertSymbol('⁹')">⁹</button>
                <button onclick="insertSymbol('⁺')">⁺</button>
                <button onclick="insertSymbol('⁻')">⁻</button>
                <button onclick="insertSymbol('⁼')">⁼</button>
                <button onclick="insertSymbol('⁽')">⁽</button>
                <button onclick="insertSymbol('⁾')">⁾</button>
                <button onclick="insertSymbol('ⁱ')">ⁱ</button>
                <button onclick="insertSymbol('ⁿ')">ⁿ</button>
                <button onclick="insertSymbol('₀')">₀</button>
                <button onclick="insertSymbol('₁')">₁</button>
                <button onclick="insertSymbol('₂')">₂</button>
                <button onclick="insertSymbol('₃')">₃</button>
                <button onclick="insertSymbol('₄')">₄</button>
                <button onclick="insertSymbol('₅')">₅</button>
                <button onclick="insertSymbol('₆')">₆</button>
                <button onclick="insertSymbol('₇')">₇</button>
                <button onclick="insertSymbol('₈')">₈</button>
                <button onclick="insertSymbol('₉')">₉</button>
                <button onclick="insertSymbol('₊')">₊</button>
                <button onclick="insertSymbol('₋')">₋</button>
                <button onclick="insertSymbol('₌')">₌</button>
                <button onclick="insertSymbol('₍')">₍</button>
                <button onclick="insertSymbol('₎')">₎</button>
                <button onclick="insertSymbol('ₐ')">ₐ</button>
                <button onclick="insertSymbol('ₑ')">ₑ</button>
                <button onclick="insertSymbol('ₒ')">ₒ</button>
                <button onclick="insertSymbol('ᵢ')">ᵢ</button>
                <button onclick="insertSymbol('ᵣ')">ᵣ</button>
                <button onclick="insertSymbol('ᵤ')">ᵤ</button>
                <button onclick="insertSymbol('ᵥ')">ᵥ</button>
                <button onclick="insertSymbol('ₓ')">ₓ</button>
                <button onclick="insertSymbol('ᵦ')">ᵦ</button>
                <button onclick="insertSymbol('ᵧ')">ᵧ</button>
                <button onclick="insertSymbol('ᵨ')">ᵨ</button>
                <button onclick="insertSymbol('ᵩ')">ᵩ</button>
                <button onclick="insertSymbol('ᵪ')">ᵪ</button>
                <button onclick="insertSymbol('¼')">¼</button>
                <button onclick="insertSymbol('½')">½</button>
                <button onclick="insertSymbol('⅓')">⅓</button>
                <button onclick="insertSymbol('⅓')">⅓</button>
                <button onclick="insertSymbol('⅔')">⅔</button>
                <button onclick="insertSymbol('⅕')">⅕</button>
                <button onclick="insertSymbol('⅖')">⅖</button>
                <button onclick="insertSymbol('⅗')">⅗</button>
                <button onclick="insertSymbol('⅘')">⅘</button>
                <button onclick="insertSymbol('⅙')">⅙</button>
                <button onclick="insertSymbol('⅚')">⅚</button>
                <button onclick="insertSymbol('⅛')">⅛</button>
                <button onclick="insertSymbol('⅜')">⅜</button>
                <button onclick="insertSymbol('⅝')">⅝</button>
                <button onclick="insertSymbol('⅞')">⅞</button>
                <button onclick="insertSymbol('μ')">μ</button>
                <button onclick="insertSymbol('σ')">σ</button>
                <button onclick="insertSymbol('χ')">χ</button>
                <button onclick="insertSymbol('∑')">∑</button>
                <button onclick="insertSymbol('∐')">∐</button>
                <button onclick="insertSymbol('x̄')">x̄</button>
                <button onclick="insertSymbol('p̂')">p̂</button>
                <button onclick="insertSymbol('°')">°</button>
                <button onclick="insertSymbol('µ')">µ</button>
                <button onclick="insertSymbol('′')">′</button>
                <button onclick="insertSymbol('∆')">∆</button>
                <button onclick="insertSymbol('∇')">∇</button>
                <button onclick="insertSymbol('∫')">∫</button>
                <button onclick="insertSymbol('∬')">∬</button>
                <button onclick="insertSymbol('∭')">∭</button>
                <button onclick="insertSymbol('⨌')">⨌</button>
                <button onclick="insertSymbol('∮')">∮</button>
                <button onclick="insertSymbol('∯')">∯</button>
                <button onclick="insertSymbol('∰')">∰</button>
                <button onclick="insertSymbol('∱')">∱</button>
                <button onclick="insertSymbol('⨑')">⨑</button>
                <button onclick="insertSymbol('∲')">∲</button>
                <button onclick="insertSymbol('∳')">∳</button>
                <button onclick="insertSymbol('α')">α</button>
                <button onclick="insertSymbol('β')">β</button>
                <button onclick="insertSymbol('γ')">γ</button>
                <button onclick="insertSymbol('δ')">δ</button>
                <button onclick="insertSymbol('ε')">ε</button>
                <button onclick="insertSymbol('ζ')">ζ</button>
                <button onclick="insertSymbol('η')">η</button>
                <button onclick="insertSymbol('θ')">θ</button>
                <button onclick="insertSymbol('ι')">ι</button>
                <button onclick="insertSymbol('κ')">κ</button>
                <button onclick="insertSymbol('λ')">λ</button>
                <button onclick="insertSymbol('μ')">μ</button>
                <button onclick="insertSymbol('ν')">ν</button>
                <button onclick="insertSymbol('ξ')">ξ</button>
                <button onclick="insertSymbol('ο')">ο</button>
                <button onclick="insertSymbol('π')">π</button>
                <button onclick="insertSymbol('ρ')">ρ</button>
                <button onclick="insertSymbol('ς')">ς</button>
                <button onclick="insertSymbol('τ')">τ</button>
                <button onclick="insertSymbol('υ')">υ</button>
                <button onclick="insertSymbol('φ')">φ</button>
                <button onclick="insertSymbol('χ')">χ</button>
                <button onclick="insertSymbol('ψ')">ψ</button>
                <button onclick="insertSymbol('ω')">ω</button>
                <button onclick="insertSymbol('℘')">℘</button>
                <button onclick="insertSymbol('ℑ')">ℑ</button>
                <button onclick="insertSymbol('ℜ')">ℜ</button>
                <button onclick="insertSymbol('ℝ')">ℝ</button>
                <button onclick="insertSymbol('ℂ')">ℂ</button>
                <button onclick="insertSymbol('ℕ')">ℕ</button>
                <button onclick="insertSymbol('ℙ')">ℙ</button>
                <button onclick="insertSymbol('ℚ')">ℚ</button>
                <button onclick="insertSymbol('ℤ')">ℤ</button>
                <button onclick="insertSymbol('∀')">∀</button>
                <button onclick="insertSymbol('∁')">∁</button>
                <button onclick="insertSymbol('∃')">∃</button>
                <button onclick="insertSymbol('∄')">∄</button>
                <button onclick="insertSymbol('∅')">∅</button>
                <button onclick="insertSymbol('¬')">¬</button>
                <button onclick="insertSymbol('˜')">˜</button>
                <button onclick="insertSymbol('∈')">∈</button>
                <button onclick="insertSymbol('∉')">∉</button>
                <button onclick="insertSymbol('∊')">∊</button>
                <button onclick="insertSymbol('∋')">∋</button>
                <button onclick="insertSymbol('∌')">∌</button>
                <button onclick="insertSymbol('∍')">∍</button>
                <button onclick="insertSymbol('∖')">∖</button>
                <button onclick="insertSymbol('⊂')">⊂</button>
                <button onclick="insertSymbol('⊃')">⊃</button>
                <button onclick="insertSymbol('⊄')">⊄</button>
                <button onclick="insertSymbol('⊅')">⊅</button>
                <button onclick="insertSymbol('⊆')">⊆</button>
                <button onclick="insertSymbol('⊇')">⊇</button>
                <button onclick="insertSymbol('⊈')">⊈</button>
                <button onclick="insertSymbol('⊉')">⊉</button>
                <button onclick="insertSymbol('≃')">≃</button>
                <button onclick="insertSymbol('≄')">≄</button>
                <button onclick="insertSymbol('∽')">∽</button>
                <button onclick="insertSymbol('∑')">∑</button>
                <button onclick="insertSymbol('∏')">∏</button>
               
                <button onclick="insertSymbol('∂')">∂</button>
                <button onclick="insertSymbol('∀')">∀</button>
                <button onclick="insertSymbol('∃')">∃</button>
                <button onclick="insertSymbol('⇒')">⇒</button>
                <button onclick="insertSymbol('⇔')">⇔</button>
                <button onclick="insertSymbol('→')">→</button>
                <button onclick="insertSymbol('←')">←</button>
                <button onclick="insertSymbol('↦')">↦</button>
                <button onclick="insertSymbol('∞')">∞</button>
                <button onclick="insertSymbol('lim')">lim</button>
                <button onclick="insertSymbol('cos')">cod</button>
                <button onclick="insertSymbol('sin')">sin</button>
                <button onclick="insertSymbol('tan')">tan</button>


                
                <button onclick="insertSymbol('lim_{}')">Lim</button>
    <button onclick="insertSymbol('x→∞')">x→∞</button>
              <!-- Ajoutez d'autres boutons de clavier avec les symboles correspondants -->
            </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    
     
    $(document).ready(function() {
        // Compteur pour suivre le nombre de questions ajoutées
        var questionCount = 1;

        // Lorsque le bouton "Ajouter question" est cliqué
        $(document).on("click", ".ajouter-question", function() {
            questionCount++;

            // Récupérer l'ID du conteneur de la question actuelle
            var currentQuestionContainerId = $(this).parent().attr("id");

            // Créer un nouveau conteneur pour la nouvelle question
            var newQuestionContainer = $("<div>").attr("id", "question-container-" + questionCount);

            // Ajouter les champs de texte pour la nouvelle question
            newQuestionContainer.append("<h2>السؤال " + questionCount + "</h2>");
            newQuestionContainer.append('<textarea class="textarea-field" name="question_text[' + (questionCount - 1) + ']" placeholder="نص السؤال"></textarea>');
            
            const questionPhoto = document.createElement('file');
            questionPhoto.name = 'question_img[]';
            questionPhoto.placeholder = 'صورة';
            newQuestionContainer.append("<h2>الاختيارات</h2>");

            // Ajouter les champs de texte pour les réponses
            for (var i = 0; i < 3; i++) {
                var responseContainer = $('<div class="response-container">');
                responseContainer.append('<label class="radio-container">');
                responseContainer.append('<input type="radio" name="is_correct[' + (questionCount - 1) + '][]" value="' + i + '">');
                responseContainer.append('<span class="checkmark"></span>');
                responseContainer.append('</label>');
                responseContainer.append('<input type="text" class="input-field" name="choice_text[' + (questionCount - 1) + '][]" placeholder="اختيار">');
                newQuestionContainer.append(responseContainer);
             
            }
            newQuestionContainer.append(' <input type="file" name="question_img[]" id="file" ><br><br>');
            // Bouton "Supprimer question" pour supprimer la question entière
            newQuestionContainer.append('<button type="button" class="supprimer-question cc">حذف سؤال </button>');

            // Ajouter le nouveau bouton "Ajouter question" à la fin de la nouvelle question
            newQuestionContainer.append('<button type="button" class="ajouter-question cc"> اضافة سؤال</button>');

            // Insérer la nouvelle question après la question actuelle
            $("#" + currentQuestionContainerId).after(newQuestionContainer);
        });

        // Lorsque le bouton "Supprimer réponse" est cliqué
        $(document).on("click", ".supprimer-reponse", function() {
            // Récupérer le conteneur de la réponse à supprimer
            var reponseContainer = $(this).parent();

            // Vérifier s'il y a plus d'une réponse dans la question
            if (reponseContainer.siblings(".response-container").length > 0) {
                // Supprimer l'input de la réponse correspondante
                reponseContainer.find("input[type='text']").remove();
                // Supprimer le radio et le bouton "Supprimer réponse" correspondants
                reponseContainer.find("input[type='radio']").remove();
                reponseContainer.find(".supprimer-reponse").remove();
            } else {
                alert("Vous ne pouvez pas supprimer toutes les réponses. Chaque question doit avoir au moins une réponse.");
            }
        });

        // Lorsque le bouton "Supprimer question" est cliqué
        $(document).on("click", ".supprimer-question", function() {
            // Récupérer le conteneur de la question à supprimer
            var questionContainer = $(this).parent();

            // Supprimer la question entière
            questionContainer.remove();
        });


        function insertSymbol(symbol) {
            var textarea = $("#question-container-" + questionCount).find("textarea");
            var currentCursorPosition = textarea.prop("selectionStart");
            var currentValue = textarea.val();
            var newValue =
                currentValue.substring(0, currentCursorPosition) +
                symbol +
                currentValue.substring(currentCursorPosition);
            textarea.val(newValue);
        }

        // Event handler for the "Insert math symbol" button
        $(".insert-math-symbol").on("click", function () {
            $(".keyboard").toggle(); // Toggle the visibility of the math keyboard
        });

        // Event handler for the math keyboard buttons
        $(".keyboard button").on("click", function () {
            var symbol = $(this).text();
            insertSymbol(symbol);
        });

        // ... (Other event handlers for adding/removing questions, responses, etc.) ...
    });
  
</script>
</body>
</html>