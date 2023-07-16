src="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.js"
// Sélectionner les éléments du DOM
const toggleYear = document.querySelector('.toggle-year');
const yearList = document.querySelector('.year-list');

// Ajouter un écouteur d'événement pour le clic
toggleYear.addEventListener('click', function() {
  // Inverser l'affichage du yearList
  yearList.style.display = yearList.style.display === 'none' ? 'block' : 'none';
});
// Sélectionner les éléments du DOM
const toggleQuiz = document.querySelector('.toggle-quiz');
const quizList = document.querySelector('.quiz-list');

// Ajouter un écouteur d'événement pour le clic
toggleQuiz.addEventListener('click', function() {
  // Inverser l'affichage du quizList
  quizList.style.display = quizList.style.display === 'none' ? 'block' : 'none';
});

var mathField = MathQuill.getInterface(2).MathField('mathquill-editor', {
  spaceBehavesLikeTab: true,
  handlers: {
    edit: function() {
      // Vous pouvez utiliser cette fonction pour récupérer le contenu de l'éditeur mathématique à chaque modification
      var mathFieldContent = mathField.latex();
      console.log(mathFieldContent);
    }
  }
});

/* quiz */
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


    // pour lafficher fntr 
    function showAddUnitForm() {
      document.getElementById("addUnitModal").style.display = "block";
    }
    function showAddUnitPart() {
      document.getElementById("addPartModal").style.display = "block";
    }
    function showAddCour() {
      document.getElementById("addCourModal").style.display = "block";
    }
    function showDeleteUnitForm() {
      document.getElementById("DeleteUnitModal").style.display = "block";
    }
    function showDeleteUnitPart() {
      document.getElementById("DeletePartModal").style.display = "block";
    }
    function showDeleteCour() {
      document.getElementById("DeleteCourModal").style.display = "block";
    }
    function showEditUnitForm() {
      document.getElementById("EditUnitModal").style.display = "block";
    }
    function showEditUnitPart() {
      document.getElementById("EditPartModal").style.display = "block";
    }
    function showEditCour() {
      document.getElementById("EditCourModal").style.display = "block";
    }

    // Fermer fntr
    function closeAddUnitModal() {
      document.getElementById("addUnitModal").style.display = "none";
    }
    function closeAddPartModal() {
      document.getElementById("addPartModal").style.display = "none";
    }
    function closeAddCourModal() {
      document.getElementById("addCourModal").style.display = "none";
    }
    function closeDeleteUnitModal() {
      document.getElementById("DeleteUnitModal").style.display = "none";
    }
    function closeDeletePartModal() {
      document.getElementById("DeletePartModal").style.display = "none";
    }
    function closeDeleteCourModal() {
      document.getElementById("DeleteCourModal").style.display = "none";
    }
    function closeEditUnitModal() {
      document.getElementById("EditUnitModal").style.display = "none";
    }
    function closeEditPartModal() {
      document.getElementById("EditPartModal").style.display = "none";
    }
    function closeEditCourModal() {
      document.getElementById("EditCourModal").style.display = "none";
    }