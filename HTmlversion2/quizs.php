<?php
include "./includes/header.php";

// Fonction pour insérer le quiz dans la base de données
function ajouterQuiz($quizName, $courseId, $questions, $choices, $correctAnswers)
{
    global $conn;

    $insertQuizQuery = "INSERT INTO quiz (quiz_name, course_id) VALUES ('$quizName', $courseId)";
    mysqli_query($conn, $insertQuizQuery);
    $quizId = mysqli_insert_id($conn);

    for ($i = 0; $i < count($questions); $i++) {
        $questionText = $questions[$i];
        $insertQuestionQuery = "INSERT INTO question (question_text, quiz_id) VALUES ('$questionText', $quizId)";
        mysqli_query($conn, $insertQuestionQuery);
        $questionId = mysqli_insert_id($conn);

        for ($j = 0; $j < count($choices[$i]); $j++) {
            $choiceText = $choices[$i][$j];
            $isCorrect = $correctAnswers[$i][$j] ? 1 : 0;
            $insertResponseQuery = "INSERT INTO response (response_text, question_id, is_correct) VALUES ('$choiceText', $questionId, $isCorrect)";
            mysqli_query($conn, $insertResponseQuery);
        }
    }

    echo "<script>alert('Le quiz a été ajouté avec succès.')";
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ajouter_quiz"])) {
    // Récupérer les données soumises par l'utilisateur
    $quizName = $_POST["quiz_name"];
    $courseId = $_POST["course_id"];
    $questions = $_POST["question_text"];
    $choices = $_POST["choice_text"];
    $correctAnswers = $_POST["is_correct"];

    // Appeler la fonction pour ajouter le quiz
    ajouterQuiz($quizName, $courseId, $questions, $choices, $correctAnswers);
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
  <meta charset="UTF-8">
  <title>Clavier en ligne</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>لوحة التحكم</title>
  <link rel="stylesheet" href="./assets/css/all.min.css" />
  <link rel="stylesheet" href="./assets/css/framework.css" />
  <link rel="stylesheet" href="./assets/css/master.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.css" />
</head>

<body>
  <div class="responsive-table">
    <div id="question-container">
      <div class="content w-full">
        <div class="projects p-20 bg-white rad-10 m-20">
          <h2 class="mt-0 mb-20">اضافة تقويم جديد</h2>
          <form method="POST" action="">
            <input type="text" class="input-field" name="quiz_name" placeholder="عنوان التقويم">
            <select class="select-field" name="course_id">
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
                  echo '<option value="">Aucun cours trouvé</option>';
              }
              ?>
            </select>
            <div id="main-container">
              <div id="question-container-1">
                <h2>السؤال 1</h2>
                <textarea class="textarea-field" name="question_text[]" placeholder="نص السؤال"></textarea>
                <h2>الاختيارات </h2>
                <div class="input-container">
                  <label class="checkbox-container">
                    <input type="checkbox" name="is_correct[0][]" value="1">
                    <span class="checkmark"></span>
                  </label>
                  <input type="text" class="input-field" name="choice_text[0][]" placeholder="اختيار">
                  <button type="button" class="delete-choice-btn">&#10005;</button>
                </div>
                <div class="input-container">
                  <label class="checkbox-container">
                    <input type="checkbox" name="is_correct[0][]" value="0">
                    <span class="checkmark"></span>
                  </label>
                  <input type="text" class="input-field" name="choice_text[0][]" placeholder="اختيار">
                  <button type="button" class="delete-choice-btn">&#10005;</button>
                </div>
                <button type="button" class="add-choice-btn" data-container="1">Ajouter une réponse</button>
              </div>
            </div>
            <button type="button" id="add-question-btn">Ajouter une question</button>
            <button type="submit" name="ajouter_quiz">إضافة الاختبار</button>
          </form>
          <button onclick="ajouterChampInput()" class="add-question-btn" style="background-color: #cfa7c6">لإضافة حقل إدخال</button>
          </br>
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


                
                <button onclick="insertSymbol('lim_{}')">Limite</button>
    <button onclick="insertSymbol('x→∞')">→∞</button>
              <!-- Ajoutez d'autres boutons de clavier avec les symboles correspondants -->
            </div>

            <button onclick="ajouterQuestion()" class="add-question-btn" style=" background-color: #cfa7c6">لإضافة سؤال جديد</button>
          </div>
        </div>
      </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      let activeInput = null;

      $('#question-container').on('focus', '.input-field, .textarea-field', function() {
        activeInput = this;
      });

      $('#question-container').on('click', '.keyboard-button', function() {
        const symbol = $(this).data('symbol');
        insertSymbol(symbol);
      });

      function insertSymbol(symbol) {
        if (activeInput) {
          const startPos = activeInput.selectionStart || 0;
          const endPos = activeInput.selectionEnd || 0;
          const text = activeInput.value;
          activeInput.value = text.slice(0, startPos) + symbol + text.slice(endPos);
          activeInput.setSelectionRange(startPos + symbol.length, startPos + symbol.length);
        }
      }

      let inputCounter = 3; // Commencez à partir de 3 pour correspondre aux champs d'entrée existants

      function ajouterChampInput() {
        const nouvelInputContainer = document.createElement('div');
        nouvelInputContainer.classList.add('input-container');

        const nouvelCheckboxContainer = document.createElement('label');
        nouvelCheckboxContainer.classList.add('checkbox-container');

        const nouvelCheckbox = document.createElement('input');
        nouvelCheckbox.type = 'checkbox';

        const nouvelCheckmark = document.createElement('span');
        nouvelCheckmark.classList.add('checkmark');

        nouvelCheckboxContainer.appendChild(nouvelCheckbox);
        nouvelCheckboxContainer.appendChild(nouvelCheckmark);

        const nouvelInput = document.createElement('input');
        nouvelInput.type = 'text';
        nouvelInput.classList.add('input-field');
        nouvelInput.placeholder = 'اختيار ';

        const deleteButton = document.createElement('button');
        deleteButton.innerHTML = '&#10005;';
        deleteButton.classList.add('delete-choice-btn');
        deleteButton.addEventListener('click', function() {
          supprimerChampInput(this);
        });

        nouvelInputContainer.appendChild(nouvelCheckboxContainer);
        nouvelInputContainer.appendChild(nouvelInput);
        nouvelInputContainer.appendChild(deleteButton);

        const questionContainer = document.getElementById('question-container');
        questionContainer.insertBefore(nouvelInputContainer, questionContainer.lastElementChild);

        inputCounter++;
      }

      function supprimerChampInput(button) {
        const inputContainer = button.parentNode;
        inputContainer.remove();
      }

      let numeroQuestion = 2; // Variable pour suivre le numéro de la question

      function ajouterQuestion() {
        const nouvelleQuestionHTML = `
    <h2>السؤال ${numeroQuestion}</h2>
    <textarea class="textarea-field" placeholder="نص السؤال"></textarea>
    <h2>الاختيارات </h2>
    <div class="input-container">
      <label class="checkbox-container">
        <input type="checkbox">
        <span class="checkmark"></span>
      </label>
      <input type="text" class="input-field" placeholder="اختيار  ">
      <button onclick="supprimerChampInput(this)" class="delete-choice-btn">&#10005;</button>
    </div>
    <div class="input-container">
      <label class="checkbox-container">
        <input type="checkbox">
        <span class="checkmark"></span>
      </label>
      <input type="text" class="input-field" placeholder="اختيار  ">
      <button onclick="supprimerChampInput(this)" class="delete-choice-btn">&#10005;</button>
    </div>
  `;

        $('#question-container').append(nouvelleQuestionHTML);
        numeroQuestion++; // Incrémenter le numéro de la question pour la prochaine fois
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    <script>
      $(document).ready(function() {
          let questionCounter = 2;

          // Ajouter un champ de réponse
          function ajouterChampInput(container) {
              const nouvelInputContainer = document.createElement('div');
              nouvelInputContainer.classList.add('input-container');

              const nouvelCheckboxContainer = document.createElement('label');
              nouvelCheckboxContainer.classList.add('checkbox-container');

              const nouvelCheckbox = document.createElement('input');
              nouvelCheckbox.type = 'checkbox';

              const nouvelCheckmark = document.createElement('span');
              nouvelCheckmark.classList.add('checkmark');

              nouvelCheckboxContainer.appendChild(nouvelCheckbox);
              nouvelCheckboxContainer.appendChild(nouvelCheckmark);

              const nouvelInput = document.createElement('input');
              nouvelInput.type = 'text';
              nouvelInput.classList.add('input-field');
              nouvelInput.placeholder = 'اختيار ';
              nouvelInput.name = `choice_text[${container - 1}][]`;


              const deleteButton = document.createElement('button');
              deleteButton.innerHTML = '&#10005;';
              deleteButton.classList.add('delete-choice-btn');
              deleteButton.addEventListener('click', function() {
                  supprimerChampInput(this);
              });

              nouvelInputContainer.appendChild(nouvelCheckboxContainer);
              nouvelInputContainer.appendChild(nouvelInput);
              nouvelInputContainer.appendChild(deleteButton);

              const questionContainer = document.getElementById(`question-container-${container}`);
              questionContainer.insertBefore(nouvelInputContainer, questionContainer.lastElementChild);
          }

          // Supprimer un champ de réponse
          function supprimerChampInput(button) {
              const inputContainer = button.parentNode;
              inputContainer.remove();
          }

         // Ajouter une question
function ajouterQuestion() {
const questionContainer = document.createElement('div');
questionContainer.id = `question-container-${questionCounter}`;

const questionTitle = document.createElement('h2');
questionTitle.innerText = `السؤال ${questionCounter}`;

const questionTextarea = document.createElement('textarea');
questionTextarea.classList.add('textarea-field');
questionTextarea.name = 'question_text[]';
questionTextarea.placeholder = 'نص السؤال';

const choicesTitle = document.createElement('h2');
choicesTitle.innerText = 'الاختيارات';

const firstChoiceContainer = document.createElement('div');
firstChoiceContainer.classList.add('input-container');

const firstChoiceCheckboxContainer = document.createElement('label');
firstChoiceCheckboxContainer.classList.add('checkbox-container');

const firstChoiceCheckbox = document.createElement('input');
firstChoiceCheckbox.type = 'checkbox';
firstChoiceCheckbox.name = `is_correct[${questionCounter - 1}][]`;
firstChoiceCheckbox.value = '1';

const firstChoiceCheckmark = document.createElement('span');
firstChoiceCheckmark.classList.add('checkmark');

firstChoiceCheckboxContainer.appendChild(firstChoiceCheckbox);
firstChoiceCheckboxContainer.appendChild(firstChoiceCheckmark);

const firstChoiceInput = document.createElement('input');
firstChoiceInput.type = 'text';
firstChoiceInput.classList.add('input-field');
firstChoiceInput.placeholder = 'اختيار ';
firstChoiceInput.name = `choice_text[${questionCounter - 1}][]`;

const firstChoiceDeleteButton = document.createElement('button');
firstChoiceDeleteButton.innerHTML = '&#10005;';
firstChoiceDeleteButton.classList.add('delete-choice-btn');
firstChoiceDeleteButton.addEventListener('click', function () {
  supprimerChampInput(this);
});

firstChoiceContainer.appendChild(firstChoiceCheckboxContainer);
firstChoiceContainer.appendChild(firstChoiceInput);
firstChoiceContainer.appendChild(firstChoiceDeleteButton);

const questionAddChoiceButton = document.createElement('button');
questionAddChoiceButton.type = 'button';
questionAddChoiceButton.classList.add('add-choice-btn');
questionAddChoiceButton.dataset.container = questionCounter;
questionAddChoiceButton.innerText = 'Ajouter une réponse';
questionAddChoiceButton.addEventListener('click', function () {
  ajouterChampInput(this.dataset.container);
});

questionContainer.appendChild(questionTitle);
questionContainer.appendChild(questionTextarea);
questionContainer.appendChild(choicesTitle);
questionContainer.appendChild(firstChoiceContainer);
questionContainer.appendChild(questionAddChoiceButton);

const mainContainer = document.getElementById('main-container');
mainContainer.appendChild(questionContainer);

questionCounter++;
}

          // Gérer l'événement de clic sur le bouton d'ajout de réponse
          $(document).on('click', '.add-choice-btn', function() {
              const container = $(this).data('container');
              ajouterChampInput(container);
          });

          // Gérer l'événement de clic sur le bouton d'ajout de question
          $('#add-question-btn').click(function() {
              ajouterQuestion();
          });
      });
  </script>
</body>

</html>

