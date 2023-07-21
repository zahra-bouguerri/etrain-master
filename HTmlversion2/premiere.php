<?php
include "./includes/header.php";
include "./includes/topmenu.php";

// Fetch existing Filières from the database
$fetchFiliereQuery = "SELECT * FROM Filière where year_id = 1";
$fetchFiliereResult = $conn->query($fetchFiliereQuery);
?>

<!-- Rest of your HTML code -->

<div id="addUnitModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeAddUnitModal()">&times;</span>
    <h2>إضافة وحدة تعليمية</h2>
    <form method="POST">
      <label for="branch">الشعبة:</label><br>
      <select id="branch" name="branch" required>
        <option value="" disabled selected>اختر الشعبة</option>
        <?php
        // Populate the select options with existing Filières
        if ($fetchFiliereResult->num_rows > 0) {
          while ($row = $fetchFiliereResult->fetch_assoc()) {
            echo "<option value='" . $row['field_id'] . "'>" . $row['field_name'] . "</option>";
          }
        }
        ?>
      </select><br>

      <label for="unitName">ادخل اسم الوحدة:</label><br>
      <input type="text" id="unitName" name="unitName" required><br>
      <button type="submit" name="Ajouter">إضافة</button>
    </form>
  </div>
</div>

<?php
if (isset($_POST['Ajouter'])) {
  $branch = $_POST['branch'];
  $unitName = $_POST['unitName'];

  // Check if the Chapitre already exists in the selected Filière
  $checkQuery = "SELECT * FROM Chapitre WHERE chapter_name = '$unitName' AND filiere_id = '$branch'";
  $checkResult = $conn->query($checkQuery);

  if ($checkResult->num_rows > 0) {
    echo "<script>alert('هذه الوحدة التعليمية موجودة بالفعل في الشعبة المحددة.');</script>";
  } else {
    // Insert the new Chapitre record into the database
    $insertQuery = "INSERT INTO Chapitre (chapter_name, filiere_id) VALUES ('$unitName', '$branch')";
    if ($conn->query($insertQuery) === TRUE) {
      echo "<script>alert('تمت إضافة الوحدة التعليمية بنجاح.');</script>";
    } else {
      echo "Error: ";
    }
  }
}
?>
<!--end add chapitre-->



  
  <div id="addPartModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeAddPartModal()">&times;</span>
    <h2>إضافة وحدة جزئية</h2>
    <form method="POST" action="">
      <label for="branch">الشعبة:</label>
      <select id="branch" name="branch" required onchange="loadChapters(this.value)">
        <option value="" disabled selected>اختر الشعبة</option>
        <?php
        // Exécutez la requête SQL pour sélectionner les noms des filières
        $sql = "SELECT field_name, field_id FROM Filière where year_id=1";
        $result = $conn->query($sql);

        // Vérifiez s'il y a des résultats
        if ($result->num_rows > 0) {
            // Parcourez les résultats et générez les options
            while ($row = $result->fetch_assoc()) {
                $field_id = $row['field_id'];
                $field_name = $row['field_name'];
                echo '<option value="' . $field_id . '">' . $field_name . '</option>';
            }
        } else {
            echo '<option value="">Aucune filière trouvée</option>';
        }
        ?>
      </select>
      <label for="chapter">الوحدة التعلمية: </label>
      <select id="chapter" name="chapter" required>
        <option value="" disabled selected>اختر الوحدة التعليمية</option>
      </select>
      <label for="unitName">الوحدة الجزئية:</label>
      <input type="text" id="unitName" name="Sunit" required>
      <button type="submit" name="addS">إضافة</button>
    </form>
  </div>
</div>

<?php
if (isset($_POST['addS'])) {
  $branch = $_POST['branch'];
  $unitName = $_POST['chapter'];
  $Sunit = $_POST['Sunit'];

  // Check if the Chapitre already exists in the selected Filière
  $checkQuery = "SELECT * FROM sous_chapitre WHERE subchapter_name = '$Sunit' AND chapter_id = '$unitName'";
  $checkResult = $conn->query($checkQuery);

  if ($checkResult->num_rows > 0) {
    echo "<script>alert('هذه الوحدة الجزئية موجودة بالفعل في الوحدة المحددة.');</script>";
  } else {
    // Insert the new Chapitre record into the database
    $insertQuery = "INSERT INTO sous_chapitre (subchapter_name, chapter_id) VALUES ('$Sunit', '$unitName')";
    if ($conn->query($insertQuery) === TRUE) {
      echo "<script>alert('تمت إضافة الوحدة الجزئية بنجاح.');</script>";
    } else {
      echo "Error: ";
    }
  }
}
?>

<!--end add sous chapitre-->
  
            <div id="addCourModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeAddCourModal()">&times;</span>
                <h2>إضافة عنوان درس</h2>
                <form method="POST">
                  <label for="branch">الشعبة:</label>
                  <select id="branch" name="branch" required onchange="loadChapters(this.value)">
                  <option value="" disabled selected>اختر الشعبة</option>
        <?php
        // Exécutez la requête SQL pour sélectionner les noms des filières
        $sql = "SELECT field_name, field_id FROM Filière where year_id=1";
        $result = $conn->query($sql);

        // Vérifiez s'il y a des résultats
        if ($result->num_rows > 0) {
            // Parcourez les résultats et générez les options
            while ($row = $result->fetch_assoc()) {
                $field_id = $row['field_id'];
                $field_name = $row['field_name'];
                echo '<option value="' . $field_id . '">' . $field_name . '</option>';
            }
        } else {
            echo '<option value="">Aucune filière trouvée</option>';
        }
        ?>
             </select>

                  <label for="chapter">الوحدة التعلمية: </label>
                  <select id="chapter" name="chapter" required onchange="loadSubchapters(this.value)">
                  <option value="" disabled selected>اختر الوحدة التعليمية</option>
                 </select>
                 
  
                  <label for="branch">الوحدة الجزيئية: </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                  </select>
  
                  <label for="subchapter"> اضافة عنوان درس</label>
                  <input type="text" id="subchapter" name="subchapter" required>
                  <button type="submit">إضافة</button>
                </form>
              </div>
            </div>
     
</body>
   <script src="./assets/js/script.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script>
  function loadChapters(branchId) {
    // Effectuez une requête AJAX pour récupérer les chapitres en fonction de l'ID de la filière
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Réponse reçue avec succès
        var chapters = JSON.parse(this.responseText);
        var chapterSelect = document.getElementById('chapter');
        chapterSelect.innerHTML = '';

        // Générez les options des chapitres en fonction de la réponse JSON
        for (var i = 0; i < chapters.length; i++) {
          var option = document.createElement('option');
          option.value = chapters[i].chapter_id;
          option.text = chapters[i].chapter_name;
          chapterSelect.appendChild(option);
        }
      }
    };
    xhttp.open("GET", "get_chapters.php?branchId=" + branchId, true);
    xhttp.send();
  }

  function loadSubchapters(chapitreId) {
    // Effectuez une requête AJAX pour récupérer les chapitres en fonction de l'ID de la filière
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Réponse reçue avec succès
        var subchapters = JSON.parse(this.responseText);
        var subchapterSelect = document.getElementById('subchapter');
        subchapterSelect.innerHTML = '';

        // Générez les options des chapitres en fonction de la réponse JSON
        for (var i = 0; i < subchapters.length; i++) {
          var option = document.createElement('option');
          option.value = subchapters[i].chapter_id;
          option.text = subchapters[i].chapter_name;
          subchapterSelect.appendChild(option);
        }
      }
    };
    xhttp.open("GET", "get_schapters.php?chapitreId=" + chapitreId, true);
    xhttp.send();
  }
</script>





</html>
