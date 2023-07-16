<?php include "./includes/header.php"?>
<?php include "./includes/topmenu.php"?>

      <div class="container">
        <h2 class="mt-0 mb-20">اضافة منهج جديد</h2>
          <select class="select-field">
            <option value="option1">اختر السنة</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
          </select>
          <select class="select-field">
            <option value="option1">اختر الشعبة</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
          </select>
          
        <div id="sequence-container">

          <div class="question">
            <h2>الوحدة التعلمية 1</h2>
            <textarea class="textarea-field" placeholder="عنوان الوحدة التعلمية"></textarea>
          </div>

          <div class="chapter-container">
            
            <div class="chapter-title">
              <input type="text" class="input-field" placeholder="عنوان الوحدة الجزئية">
            </div>

            <div class="lesson-container">
              <div class="input-container">
                <input type="text" class="input-field" placeholder="الدرس">
                <button onclick="supprimerChampInput(this)" class="delete-choice-btn">&#10005;</button>
              </div>
            </div>

            <button onclick="ajouterLecon(this)" class="add-question-btn">إضافة درس جديد</button>
          </div>

          <button onclick="ajouterChapitre(this)" class="add-question-btn">إضافة وحدة جزئية جديدة</button>
        </div>
        <button onclick="ajouterSequence()" class="add-question-btn" style=" background-color: #cfa7c6">ضافة وحدة تعلمية جديدة</button>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    let activeInput = null;

    $('#sequence-container').on('focus', '.input-field, .textarea-field', function() {
      activeInput = this;
    });

    $('#sequence-container').on('click', '.keyboard-button', function() {
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

    let sequenceCounter = 2; // Commencez à partir de 1 pour correspondre aux séquences existantes

    function ajouterSequence() {
      const nouvelleSequenceHTML = `
        <div id="sequence-${sequenceCounter}">
          <div class="question">
            <h2>الوحدة التعلمية ${sequenceCounter}</h2>
            <textarea class="textarea-field" placeholder="عنوان الوحدة التعلمية"></textarea>
          </div>

          <div class="chapter-container">
            <div class="chapter-title">
                <input type="text" class="input-field" placeholder="عنوان الوحدة الجزئية">
            </div>

            <div class="lesson-container">
              <div class="input-container">
                <input type="text" class="input-field" placeholder="الدرس">
                <button onclick="supprimerChampInput(this)" class="delete-choice-btn">&#10005;</button>
              </div>
            </div>

            <button onclick="ajouterLecon(this)" class="add-question-btn">إضافة درس جديد</button>
          </div>

          <button onclick="ajouterChapitre(this)" class="add-question-btn">إضافة وحدة جزئية جديدة</button>
        </div>
      `;

      $('#sequence-container').append(nouvelleSequenceHTML);
      sequenceCounter++; // Incrémenter le numéro de la séquence pour la prochaine fois
    }

    function ajouterChapitre(button) {
      const sequenceContainer = button.parentNode;
      const chapitreContainer = sequenceContainer.querySelector('.chapter-container');
      const chapitreCount = chapitreContainer.querySelectorAll('.lesson-container').length + 1;

      const nouveauChapitreHTML = `
        <div class="chapter-container">
          <div class="chapter-title">
            <input type="text" class="input-field" placeholder="عنوان الوحدة الجزئية">
          </div>

          <div class="lesson-container">
            <div class="input-container">
              <input type="text" class="input-field" placeholder="الدرس">
              <button onclick="supprimerChampInput(this)" class="delete-choice-btn">&#10005;</button>
            </div>
          </div>

          <button onclick="ajouterLecon(this)" class="add-question-btn">إضافة درس جديد</button>
        </div>
      `;

      chapitreContainer.insertAdjacentHTML('beforeend', nouveauChapitreHTML);
    }

    function ajouterLecon(button) {
      const chapitreContainer = button.parentNode;
      const leconContainer = chapitreContainer.querySelector('.lesson-container');

      const nouvelleLeconHTML = `
        <div class="lesson-container">
          <div class="input-container">
            <input type="text" class="input-field" placeholder="الدرس">
            <button onclick="supprimerChampInput(this)" class="delete-choice-btn">&#10005;</button>
          </div>
        </div>
      `;

      leconContainer.insertAdjacentHTML('beforeend', nouvelleLeconHTML);
    }

    function supprimerChampInput(button) {
      const inputContainer = button.parentNode;
      inputContainer.remove();
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./assets/js/script.js"></script>
</body>

</html>
