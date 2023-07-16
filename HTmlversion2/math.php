<!DOCTYPE html>
<html>
<head>
  <title>Clavier Mathématique</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.css">
</head>
<body>
  <div id="expression">
    <div class="expression"></div>
    <div class="expression"></div>
    <div class="expression"></div>
  </div>
  
  <div id="keyboard">
    <button class="operator">+</button>
    <button class="operator">-</button>
    <button class="operator">*</button>
    <button class="operator">/</button>
    <button class="function">sin</button>
    <button class="function">cos</button>
    <button class="function">tan</button>
    <button class="function">log</button>
    <button class="symbol">\int</button>
    <button class="symbol">\lim</button>
    <button class="number">0</button>
    <button class="number">1</button>
    <button class="number">2</button>
    <button class="number">3</button>
    <button class="number">4</button>
    <button class="number">5</button>
    <button class="number">6</button>
    <button class="number">7</button>
    <button class="number">8</button>
    <button class="number">9</button>
    <button id="clear">C</button>
    <button id="evaluate">=</button>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.js"></script>
  <script src="script.js"></script>
  <script>
   document.addEventListener('DOMContentLoaded', function() {
  var expressionFields = document.querySelectorAll('#expressions .expression');
  
  expressionFields.forEach(function(expressionField) {
    var mathField = MathQuill.MathField(expressionField, {
      handlers: {
        edit: function() {
          // Fonction appelée lors de la modification du champ MathQuill
        }
      }
    });
  });

  var keyboardButtons = document.querySelectorAll('#keyboard button');

  keyboardButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      // Récupérez le champ MathQuill actif ou utilisez un sélecteur spécifique pour chaque champ MathQuill
      var activeField = document.querySelector('.mq-focused .mq-editable-field');

      var buttonText = this.textContent;

      if (buttonText === '=') {
        try {
          var result = activeField.textContent;
          // Faites quelque chose avec le texte de la formule, comme l'évaluer côté serveur ou l'afficher dans un autre format
        } catch (error) {
          console.error(error);
        }
      } else if (buttonText === 'C') {
        activeField.textContent = '';
      } else {
        activeField.textContent += buttonText;
      }
    });
  });
});


  </script>
</body>
</html>
