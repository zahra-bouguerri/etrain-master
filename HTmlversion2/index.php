<?php include "./includes/header.php"; ?>

<body>
<div class="projects p-20 bg-white rad-10 m-20">
        <h2 class="mt-0 mb-20">اضافة منهج جديد</h2>
        <form method="POST" action="">
            <select class="select-field" name="year_id" id="yearSelect" required>
                <?php
                // Exécutez la requête SQL pour sélectionner les noms des années
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
                    echo '<option value="">Aucune année trouvée</option>';
                }
                ?>
            </select>
            <select class="select-field" name="field_id" id="fieldSelect" required>
                <option value="">اختر السنة الدراسية أولاً</option>
            </select>
            <button type="submit">Filtrer</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Vérifier si l'utilisateur a sélectionné une filière
        if (isset($_POST['field_id']) && !empty($_POST['field_id'])) {
            // Échapper pour éviter les injections SQL (utilisation recommandée de requêtes préparées, mais cela suffit pour un exemple simple)
            $selectedFieldId = $_POST['field_id'];
            $selectedFieldId = $conn->real_escape_string($selectedFieldId);

            // Requête SQL pour filtrer les chapitres en fonction de la filière sélectionnée
            $sql = "SELECT chapter_name, subchapter_name, course_name FROM chapitre
                    INNER JOIN sous_chapitre ON chapitre.chapter_id = sous_chapitre.chapter_id
                    INNER JOIN cours ON sous_chapitre.subchapter_id = cours.subchapter_id
                    WHERE chapitre.filiere_id = $selectedFieldId
                    ORDER BY chapter_name DESC, subchapter_name DESC, course_name DESC"; // Order by descending
        } else {
            // Requête SQL pour récupérer tous les chapitres si aucune filière n'est sélectionnée
            $sql = "SELECT chapter_name, subchapter_name, course_name FROM chapitre
                    INNER JOIN sous_chapitre ON chapitre.chapter_id = sous_chapitre.chapter_id
                    INNER JOIN cours ON sous_chapitre.subchapter_id = cours.subchapter_id
                    ORDER BY chapter_name DESC, subchapter_name DESC, course_name DESC"; // Order by descending
        }

        $result = $conn->query($sql);

        // Step 3: Organize the data into arrays to build the table
        $tableData = array();
        while ($row = $result->fetch_assoc()) {
            $chapter = $row['chapter_name'];
            $subchapter = $row['subchapter_name'];
            $course = $row['course_name'];

            // Organize data into a multidimensional array
            $tableData[$chapter][$subchapter][] = $course;
        }

        // Step 4: Generate the table HTML dynamically
        echo '<div class="projects p-20 bg-white rad-10 m-20">';
        echo '<h2 class="mt-0 mb-20">منهج الرياضيات الخاص بالسنة اولى ثانوي علمي</h2>';
        echo '<div class="responsive-table">';
        echo '<table class="fs-15 w-full">';
        echo '<thead><tr><td>الوحدات التعليمية</td><td>الوحدات الجزئية</td><td>الدروس</td></tr></thead>';
        echo '<tbody>';

        // Sort the chapters in ascending order
        ksort($tableData);

        // Loop through the data and generate table rows
        foreach ($tableData as $chapter => $subchapters) {
            echo '<tr><td rowspan="' . count($subchapters) . '">' . $chapter . '</td>';
            $firstSubchapter = true;

            // Sort the subchapters in ascending order
            ksort($subchapters);

            // Loop through subchapters for each chapter
            foreach ($subchapters as $subchapter => $courses) {
                if (!$firstSubchapter) {
                    echo '<tr>';
                }
                echo '<td>' . $subchapter . '</td>';

                // Sort the courses in ascending order
                sort($courses);

                echo '<td>' . implode('<br>', $courses) . '</td>';
                echo '</tr>';
                $firstSubchapter = false;
            }
        }

        echo '</tbody></table>';
        echo '</div>';
        echo '</div>';
    }
    // Close the database connection
    $conn->close();
    ?>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Ciblez les menus déroulants d'année et de filière
        const yearSelect = document.getElementById("yearSelect");
        const fieldSelect = document.getElementById("fieldSelect");

        // Écoutez les changements dans le menu déroulant d'année
        yearSelect.addEventListener("change", function () {
            // Récupérez la valeur de l'année sélectionnée
            const selectedYearId = yearSelect.value;

            // Utilisez la valeur de l'année sélectionnée pour récupérer les filières associées
            fetchFiliereOptions(selectedYearId);
        });

        // Fonction pour récupérer les options de filière en fonction de l'année sélectionnée
        function fetchFiliereOptions(yearId) {
            // Effectuez une requête AJAX pour récupérer les filières
            fetch(`get_filiere_options.php?year_id=${yearId}`)
                .then((response) => response.text())
                .then((data) => {
                    // Mettez à jour les options du menu déroulant de filière
                    fieldSelect.innerHTML = data;
                })
                .catch((error) => {
                    console.error("Erreur lors de la récupération des filières :", error);
                });
        }
    });
</script>
