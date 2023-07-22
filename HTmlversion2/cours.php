<?php
include "./includes/header.php";?>

      <div class="content w-full">
        <div class="projects p-20 bg-white rad-10 m-20">
          <h2 class="mt-0 mb-20">ادارة الدروس</h2>
          <form method="POST">
      <label for="branch">:السنة</label>
      <select name="" id="branch" required onchange="loadBranch(this.value)">
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
                    echo '<option value="">Aucun annee trouvé</option>';
                }
                ?>
            </select>
          <label> :الشعبة </label>
          <select id="fil1" name="branch" required onchange="loadChapters(this.value)">
                  <option value="" disabled selected>اختر الشعبة</option>
             </select>

              <br>  <label >الوحدة التعلمية: </label>
                  <select id="chapter" name="chapter" required onchange="loadSubchapters(this.value)">
                  <option value="" disabled selected>اختر الوحدة التعليمية</option>
                 </select>
                 
  
                 <br>  <label>الوحدة الجزيئية: </label>
                  <select id="subchapter" name="subchapter" required onchange="loadCours(this.value)">
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                  </select>

                  <br>  <label> :الدرس </label>
                  <select id="cours" name="subchapter" required>
                    <option value="" disabled selected>اختر الدرس </option>
                  </select>
          <div class="responsive-table">
            <div id="question-container">
               
    
                <li class="add-question-btn">
                  <label for="videoFile" class="add-question-btn">
                    <i class="fas fa-plus"></i>
                    <span>اضافة فيديو</span>
                    <input type="file" name="vidio[]" id="videoFile" accept="video/*" onchange="handleFileSelect(event)" style="display: none;">
          
                  </label>
                </li>
                <li class="add-question-btn">
                  <label for="videoFile" class="add-question-btn">
                    <i class="fas fa-plus"></i>
                    <span>اضافة ملف</span>
                    <input type="file" name="pdf[]" id="file" >
          
                  </label>
                </li>
                  <video id="videoPlayer" controls style="display: none;"></video>


              
            </div>

          </div>
          <button type="submit" name="ajouter_field">إضافة </button>
        </div>
      </div>

    </div>
    


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>


    function handleFileSelect(event) {
    const file = event.target.files[0];
    const videoPlayer = document.getElementById("videoPlayer");
    
    if (file) {
        const fileURL = URL.createObjectURL(file);
        videoPlayer.src = fileURL;
        videoPlayer.style.display = "block";
    }
    }
    
   




    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>
<script>
function loadSubchapters(chapitreId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var subchapters = JSON.parse(this.responseText);
      var subchapterSelect = document.getElementById('subchapter');
      
      // Clear the select options before populating
      subchapterSelect.innerHTML = '';
      
      // Add the initial empty and disabled option
      var initialOption = document.createElement('option');
      initialOption.value = "";
      initialOption.disabled = true;
      initialOption.selected = true;
      initialOption.textContent = "اختر الوحدة الجزئية";
      subchapterSelect.appendChild(initialOption);

      // Populate the select with the filtered subchapters
      for (var i = 0; i < subchapters.length; i++) {
        var option = document.createElement('option');
        option.value = subchapters[i].subchapter_id;
        option.text = subchapters[i].subchapter_name;
        subchapterSelect.appendChild(option);
      }
    }
  };
  xhttp.open("GET", "get_schapters.php?chapitreId=" + chapitreId, true);
  xhttp.send();
}

function loadChapters(branchId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var chapters = JSON.parse(this.responseText);
      var chapterSelect = document.getElementById('chapitre');

      // Clear the select options before populating
      chapterSelect.innerHTML = '';

      // Add the initial empty and disabled option
      var initialOption = document.createElement('option');
      initialOption.value = "";
      initialOption.disabled = true;
      initialOption.selected = true;
      initialOption.textContent = "اختر الوحدة التعليمية";
      chapterSelect.appendChild(initialOption);

      // Populate the select with the filtered chapters
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

function loadCours(coursId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var courses = JSON.parse(this.responseText);
      var coursSelect = document.getElementById('cours');

      // Clear the select options before populating
      coursSelect.innerHTML = '';

      // Add the initial empty and disabled option
      var initialOption = document.createElement('option');
      initialOption.value = "";
      initialOption.disabled = true;
      initialOption.selected = true;
      initialOption.textContent = "اختر الدرس";
      coursSelect.appendChild(initialOption);

      // Populate the select with the filtered cours
      for (var i = 0; i < courses.length; i++) {
        var option = document.createElement('option');
        option.value = courses[i].course_id;
        option.text = courses[i].course_name;
        coursSelect.appendChild(option);
      }
    }
  };
  xhttp.open("GET", "get_cours.php?coursId=" + coursId, true);
  xhttp.send();
}

function loadBranch(year) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var branchs = JSON.parse(this.responseText);
      var branchSelect = document.getElementById('fil1');

      // Clear the select options before populating
      branchSelect.innerHTML = '';

      // Add the initial empty and disabled option
      var initialOption = document.createElement('option');
      initialOption.value = "";
      initialOption.disabled = true;
      initialOption.selected = true;
      initialOption.textContent = "اختر الشعبة";
      branchSelect.appendChild(initialOption);

      // Populate the select with the filtered chapters
      for (var i = 0; i < branchs.length; i++) {
        var option = document.createElement('option');
        option.value = branchs[i].branch_id;
        option.text = branchs[i].branch_name;
        branchSelect.appendChild(option);
      }
    }
  };
  xhttp.open("GET", "get_filiere.php?year=" + year, true);
  xhttp.send();
}

function loadCours(subchapterId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var courses = JSON.parse(this.responseText);
      var coursSelect = document.getElementById('cours');

      // Clear the select options before populating
      coursSelect.innerHTML = '';

      // Add the initial empty and disabled option
      var initialOption = document.createElement('option');
      initialOption.value = "";
      initialOption.disabled = true;
      initialOption.selected = true;
      initialOption.textContent = "اختر الدرس";
      coursSelect.appendChild(initialOption);

      // Populate the select with the filtered cours
      for (var i = 0; i < courses.length; i++) {
        var option = document.createElement('option');
        option.value = courses[i].id;
        option.text = courses[i].name;
        coursSelect.appendChild(option);
      }
    }
  };
  xhttp.open("GET", "get_cours.php?subchapterId=" + $subchapterId, true);
  xhttp.send();
}
</script>
</html>