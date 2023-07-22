<?php

include "./includes/header.php";

// Fonction pour insérer le programme dans la base de données
function ajouterField($fieldName, $yearId, $sequences, $Chapitres, $cours, $conn)
{
     // Check if the filiere name already exists
     $fieldExistsQuery = "SELECT COUNT(*) FROM filière WHERE field_name = '$fieldName'";
     $result = mysqli_query($conn, $fieldExistsQuery);
     $row = mysqli_fetch_array($result);
     $fieldCount = $row[0];
 
     if ($fieldCount > 0) {
         // Filiere name already exists, do not add it again
         echo '<script>alert("اسم الشعبة موجود بالفعل.");</script>';
         return;
     }
 
     // Insert the new filiere in the filiere table
     $insertFieldQuery = "INSERT INTO filière (field_name, year_id) VALUES ('$fieldName', $yearId)";
     mysqli_query($conn, $insertFieldQuery);
     $fieldId = mysqli_insert_id($conn); // Get the inserted filiere ID

     for ($i = 0; $i < count($sequences); $i++) {
        $sequenceText = $sequences[$i];

        // Check if the chapter name exists within the filiere
        $sequenceExistsQuery = "SELECT COUNT(*) FROM chapitre WHERE chapter_name = '$sequenceText' AND filiere_id = $fieldId";
        $result = mysqli_query($conn, $sequenceExistsQuery);
        $row = mysqli_fetch_array($result);
        $sequenceCount = $row[0];

        if ($sequenceCount > 0) {
            // Sequence already exists in the filiere, do not add it again
            echo '<script>alert("الوحدة التعليمية موجودة ");</script>';
            continue;
        }

        // Insert the chapter in the chapitre table
        $insertSequenceQuery = "INSERT INTO chapitre (chapter_name, filiere_id) VALUES ('$sequenceText', $fieldId)";
        mysqli_query($conn, $insertSequenceQuery);
        $sequenceId = mysqli_insert_id($conn); // Get the inserted chapter ID

        for ($j = 0; $j < count($Chapitres[$i]); $j++) {
            $ChapitreText = $Chapitres[$i][$j];

            // Check if the sous chapitre exists within the chapter
            $chapitreExistsQuery = "SELECT COUNT(*) FROM sous_chapitre WHERE subchapter_name = '$ChapitreText' AND chapter_id = $sequenceId";
            $result = mysqli_query($conn, $chapitreExistsQuery);
            $row = mysqli_fetch_array($result);
            $chapitreCount = $row[0];

            if ($chapitreCount > 0) {
                // Sous chapitre already exists in the chapter, do not add it again
                echo '<script>alert("الوحدة  موجودة الجزئية");</script>';
                continue;
            }

            // Insert the sous chapitre in the sous_chapitre table
            $insertChapitreQuery = "INSERT INTO sous_chapitre (subchapter_name, chapter_id) VALUES ('$ChapitreText', $sequenceId)";
            mysqli_query($conn, $insertChapitreQuery);
            $chapitreId = mysqli_insert_id($conn); // Get the inserted sous chapitre ID
        
            for ($k = 0; $k < count($cours[$i][$j]); $k++) {
                $coursText = $cours[$i][$j][$k];

                // Check if the cours exists within the sous chapitre
                $coursExistsQuery = "SELECT COUNT(*) FROM cours WHERE course_name = '$coursText' AND subchapter_id = $chapitreId";
                $result = mysqli_query($conn, $coursExistsQuery);
                $row = mysqli_fetch_array($result);
                $coursCount = $row[0];

                if ($coursCount > 0) {
                    // Cours already exists in the sous chapitre, do not add it again
                    echo '<script>alert("الدرس  موجودة ");</script>';
                    continue;
                }

                // Insert the cours in the cours table
                $insertCoursQuery = "INSERT INTO cours (course_name, subchapter_id) VALUES ('$coursText', $chapitreId)";
                mysqli_query($conn, $insertCoursQuery);
            }
        }
    }

    echo '<script>alert("تمت إضافة البرنامج بنجاح.");</script>';
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ajouter_field"])) {
    // Récupérer les données soumises par l'utilisateur
    $fieldName = $_POST["field_name"];
    $yearId = $_POST["year_id"];
    $sequences = $_POST["sequences_text"];
    $Chapitres = $_POST["chapitres_text"];
    $cours = $_POST["cour_text"];
  

    
    // Appeler la fonction pour ajouter le programme

    ajouterField($fieldName, $yearId, $sequences, $Chapitres, $cours, $conn);
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

    <div class="container">
        <h2 class="mt-0 mb-20">اضافة منهج جديد</h2>
        <form method="POST" action="">
            <input type="text" class="input-field" name="field_name" placeholder=" اسم الشعبة" required>

            <select class="select-field" name="year_id" required>
                <?php
                // Exécutez la requête SQL pour sélectionner les noms des chapitres
                $sql = "SELECT year_name, year_id FROM année";
                $result = $conn->query($sql);

                // Vérifiez s'il y a des résultats
                if ($result->num_rows > 0) {
                    // Parcourez les résultats et générez les options
                    echo ' <option value="">اختر السنة الدراسية </option>';
                    while ($row = $result->fetch_assoc()) {
                        $yearName = $row['year_name'];
                        $yearId = $row['year_id'];
                        echo '<option value="' . $yearId . '">' . $yearName . '</option>';
                    }
                } else {
                    echo '<option value="">Aucun cours trouvé</option>';
                }
                ?>
            </select>

            <div id="sequence-container">

                <div class="question">
                    <h2>الوحدة التعلمية 1</h2>
                    <textarea class="textarea-field" name="sequences_text[]" placeholder="عنوان الوحدة التعلمية"
                        required></textarea>
                </div>

        
                <div class="chapter-container">
                    <div class="chapter-title">
                        <input type="text" class="input-field" name="chapitres_text[0][]" placeholder="عنوان الوحدة الجزئية" required>
                    </div>

                    <div class="lesson-container">
                        <div class="input-container">
                            <input type="text" class="input-field" name="cour_text[0][0][]" placeholder="الدرس" required>
                            <button onclick="supprimerChampInput(this)" class="delete-choice-btn">&#10005;</button>
                        </div>
                    </div>

    <button onclick="ajouterLecon(this)" class="add-question-btn">إضافة درس جديد</button>
</div>
<!-- ... More HTML code ... -->


                    

                <button onclick="ajouterChapitre(this)" class="add-question-btn">إضافة وحدة جزئية جديدة</button>
            </div>
            <button onclick="ajouterSequence()" class="add-question-btn" style="background-color: #cfa7c6">ضافة وحدة تعلمية
                جديدة</button>
            <button type="submit" name="ajouter_field">إضافة المنهج</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let activeInput = null;

        $('#sequence-container').on('focus', '.input-field, .textarea-field', function () {
            activeInput = this;
        });

        $('#sequence-container').on('click', '.keyboard-button', function () {
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
                        <textarea class="textarea-field" name="sequences_text[]" placeholder="عنوان الوحدة التعلمية" required></textarea>
                    </div>

                    <div class="chapter-container">
                        <div class="chapter-title">
                            <input type="text" class="input-field" name="chapitres_text[${sequenceCounter - 1}][]" placeholder="عنوان الوحدة الجزئية" required>
                        </div>

                        <div class="lesson-container">
                            <div class="input-container">
                                <input type="text" class="input-field" name="cour_text[${sequenceCounter - 1}][0][]" placeholder="الدرس" required>
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

            // Mettre à jour le tableau sequences_text[]
            const sequencesTextArray = document.querySelectorAll('textarea[name="sequences_text[]"]');
            const sequencesTextValues = Array.from(sequencesTextArray).map(textarea => textarea.value);
            console.log(sequencesTextValues);
                    
        }
        function ajouterLecon(button) {
            const chapitreContainer = button.parentNode;
            const leconContainer = chapitreContainer.querySelector('.lesson-container');
            const coursInput = leconContainer.querySelector('.input-field');
            const sousChapitreIndex = Array.from(chapitreContainer.parentNode.children).indexOf(chapitreContainer);

            const nouvelleLeconHTML = `
                <div class="lesson-container">
                    <div class="input-container">
                        <input type="text" class="input-field" name="cour_text[${sequenceCounter - 1}][${sousChapitreIndex}][]" placeholder="الدرس" required>
                        <button onclick="supprimerChampInput(this)" class="delete-choice-btn">&#10005;</button>
                    </div>
                </div>
            `;

            leconContainer.insertAdjacentHTML('beforeend', nouvelleLeconHTML);

            // Mettre à jour le tableau cour_text[][]
            const coursTextArray = chapitreContainer.querySelectorAll('input[name^="cour_text"]');
            const coursTextValues = Array.from(coursTextArray).map(input => input.value);
            console.log(coursTextValues);
        }

        function ajouterChapitre(button) {
                    const sequenceContainer = button.parentNode;
            const chapitreContainer = sequenceContainer.querySelector('.chapter-container');
            const chapitreCount = chapitreContainer.querySelectorAll('.lesson-container').length + 1;

            const nouveauChapitreHTML = `
                <div class="chapter-container">
                    <div class="chapter-title">
                        <input type="text" class="input-field" name="chapitres_text[${sequenceCounter - 1}][]" placeholder="عنوان الوحدة الجزئية" required>
                    </div>

                    <div class="lesson-container">
                        <div class="input-container">
                            <input type="text" class="input-field" name="cour_text[${sequenceCounter - 1}][${chapitreCount - 1}][]" placeholder="الدرس" required>
                            <button onclick="supprimerChampInput(this)" class="delete-choice-btn">&#10005;</button>
                        </div>
                    </div>

                    <button onclick="ajouterLecon(this)" class="add-question-btn">إضافة درس جديد</button>
                </div>
            `;

            chapitreContainer.insertAdjacentHTML('beforeend', nouveauChapitreHTML);

            // Mettre à jour le tableau chapitres_text[][]
            const chapitresTextArray = chapitreContainer.querySelectorAll('input[name^="chapitres_text"]');
            const chapitresTextValues = Array.from(chapitresTextArray).map(input => input.value);
            console.log(chapitresTextValues);
        }

        function supprimerChampInput(button) {
            const inputContainer = button.parentNode;
            inputContainer.remove();
        }

        // Assurez-vous que tous les champs requis sont remplis avant d'activer le bouton de soumission
        function checkFormValidity() {
            const requiredInputs = document.querySelectorAll('.input-field[required], .textarea-field[required], select[required]');
            let isFormValid = true;

            requiredInputs.forEach(input => {
                if (input.value.trim() === '') {
                    isFormValid = false;
                }
            });

            const submitButton = document.querySelector('button[name="ajouter_field"]');
            submitButton.disabled = !isFormValid;
        }

        // Écoutez les événements de saisie pour vérifier la validité du formulaire
        document.addEventListener('input', checkFormValidity);
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>