 <?php include "./includes/header.php"?>

      <div class="content w-full">
        <div class="projects p-20 bg-white rad-10 m-20">
          <h2 class="mt-0 mb-20">اضافة تقويم جديد</h2>
          <select class="select-field">
            <option value="option1">اختر الوحدة التعلمية</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
          </select>
          <select class="select-field">
            <option value="option1">اختر الوحدة الجزئية</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
          </select>
          <select class="select-field">
            <option value="option1">اختر الدرس</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
          </select>
          <div class="responsive-table">
            <div id="question-container">

              <h2>السؤال 1</h2>
              
              <textarea dir="auto" class="textarea-field" placeholder="نص السؤال"></textarea>
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

            </div>
            <button onclick="ajouterChampInput()" class="add-question-btn" style=" background-color: #cfa7c6">لإضافة حقل إدخال</button>
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
    <script src="./assets/js/script.js"></script>
</body>

</html>

