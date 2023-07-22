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
      <input type="text" id="unitName" name="unitName" required>
      <label for="cours"> حالة  </label>
      <select name="etat" class="niveau" >
                  <option value=""> --اختر--</option>
                 <option value=" جديد"> جديد</option>
                </select>
      <button type="submit" name="Ajouter">إضافة</button>
    </form>
  </div>
</div>

<?php
if (isset($_POST['Ajouter'])) {
  $branch = $_POST['branch'];
  $unitName = $_POST['unitName'];
  $etat=$_POST['etat'];
  // Check if the Chapitre already exists in the selected Filière
  $checkQuery = "SELECT * FROM Chapitre WHERE chapter_name = '$unitName' AND filiere_id = '$branch'";
  $checkResult = $conn->query($checkQuery);

  if ($checkResult->num_rows > 0) {
    echo "<script>alert('هذه الوحدة التعليمية موجودة بالفعل في الشعبة المحددة.');</script>";
  } else {
    // Insert the new Chapitre record into the database
    $insertQuery = "INSERT INTO Chapitre (chapter_name, filiere_id,etat) VALUES ('$unitName', '$branch','$etat')";
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
      <label for="subchapter">الوحدة الجزئية:</label>
      <input type="text" id="subchapter" name="Sunit" required>
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
                  <select id="branch2" name="branch" required onchange="loadChapters2(this.value)">
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
                  <select id="chapter2" name="chapter" required onchange="loadSubchapters(this.value)">
                  <option value="" disabled selected>اختر الوحدة التعليمية</option>
                 </select>
                 
  
                  <label for="subchapter">الوحدة الجزيئية: </label>
                  <select id="subchapter2" name="subchapter2" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                  </select>
  
                  <label for="cours"> اضافة عنوان درس</label>
                  <input type="text" id="cours" name="cours" required>
                  <label for="cours"> حالة  </label>
                  <select name="etat" class="niveau" >
                  <option value=""> --اختر--</option>
                 <option value=" جديد"> جديد</option>
                </select>
                  <button type="submit" name="addc">إضافة</button>
                </form>
              </div>
            </div>

            <?php
if (isset($_POST['addc'])) {
  $subchapter = $_POST['subchapter2'];
  $courseTitle = $_POST['cours'];
  $etat=$_POST['etat'];
  // Check if the Chapitre already exists in the selected Filière
  $checkQuery = "SELECT * FROM cours WHERE course_name = '$courseTitle' AND subchapter_id = '$subchapter'";
  $checkResult = $conn->query($checkQuery);

  if ($checkResult->num_rows > 0) {
    echo "<script>alert('هذه  الدرس موجودة بالفعل في الوحدة .');</script>";
  } else {
    // Insert the new Chapitre record into the database
    $insertQuery = "INSERT INTO cours (course_name, subchapter_id,etat) VALUES ('$courseTitle', '$subchapter','$etat')";
    if ($conn->query($insertQuery) === TRUE) {
      echo "<script>alert('تمت إضافة عنوان الدرس بنجاح.');</script>";
    } else {
      echo "<script>alert('حدث خطأ أثناء إضافة عنوان الدرس.');</script>";
    }
  }
}
?>
      



          
          <!--start delete chapitre-->
          <?php
if (isset($_GET['delete'])) {
    $chapter_id = $_GET['delete'];

    // Check if there are any dependent "sous_chapitre" records
    $checkQuery = "SELECT COUNT(*) as count FROM sous_chapitre WHERE chapter_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $chapter_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];

    if ($count > 0) {
        // Display a message that related "sous_chapitre" records must be deleted first
        echo "<script>alert('لا يمكن حذف الوحدة التعليمية لأنها تحتوي على وحدات جزئية. يرجى حذف الوحدات الجزئية أولاً.');</script>";
    } else {
        // No dependent records, proceed with the deletion
        $deleteSql = "DELETE FROM chapitre WHERE chapter_id = ?";
        $stmt = $conn->prepare($deleteSql);
        $stmt->bind_param("s", $chapter_id);
        $deleteResult = $stmt->execute();

        if ($deleteResult) {
            // Successful deletion
            echo "<script>alert('تم حذف الوحدة التعليمية بنجاح.');</script>";
       
            exit();
        } else {
            // Deletion failed
            echo "<script>alert('حدث خطأ أثناء حذف الوحدة التعليمية.');</script>";
        }
    }
}

// Fetch existing Filières from the database
$fetchFiliereQuery2 = "SELECT * FROM Filière where year_id = 1";
$fetchFiliereResult2 = $conn->query($fetchFiliereQuery2);
?>
            <!-- fenetre flottante delete -->
            <div id="DeleteUnitModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteUnitModal()">&times;</span>
        <h2>حذف الوحدة التعلمية:</h2>
        <form>
            <label for="branch">الشعبة:</label><br>
            <select id="branch3" name="branch" required onchange="loadChapters3(this.value)">
    <option value="" disabled selected>اختر الشعبة</option>
    <?php
    // Populate the select options with existing Filières
    if ($fetchFiliereResult2->num_rows > 0) {
        while ($row = $fetchFiliereResult2->fetch_assoc()) {
            echo "<option value='" . $row['field_id'] . "'>" . $row['field_name'] . "</option>";
        }
    }
    ?>
</select><br>
            <label for="branch">الوحدة التعلمية:</label>
            <div class="responsive-table">
                <table class="fs-15 w-full">
                    <thead>
                        <tr>
                            <td>اسم الوحدة التعلمية:</td>
                            <td> حذف</td>
                        </tr>
                    </thead>
                    <tbody id="chapter-table-body">
                        <?php
                        // Your existing PHP code for fetching chapters will remain here
                        $selectQuery3 = "SELECT * FROM chapitre";
                        $result3 = $conn->query($selectQuery3);
                        if ($result3 && $result3->num_rows > 0) {
                            while ($row = $result3->fetch_assoc()) {
                                ?>
                                <tr class="chapter-row" data-filiere="<?php echo $row['filiere_id']; ?>">
                                    <td><?php echo $row['chapter_name']; ?></td>
                                    <td>
                                        <a href="?delete=<?php echo $row['chapter_id']; ?>" onclick="return confirm('هل أنت متأكد من حذف هذه الوحدة التعلمية:')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='6'>لا توجد وحدة تعلمية</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
         <!--end delete chapitre-->
  
<div id="DeletePartModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeDeletePartModal()">&times;</span>
    <h2> حذف وحدة جزئية</h2>
    <form>
      <label for="branch">الشعبة:</label>
      <select id="branch6" name="branch" required onchange="loadChapters5(this.value)">
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
      <select id="chapter5" name="chapter" required onchange="loadSubchapters5(this.value)">
        <option value="" disabled selected>اختر الوحدة التعليمية</option>
      </select>
      
      <div class="responsive-table">
        <table class="fs-15 w-full">
          <thead>
            <tr>
              <td>اسم الوحدة الجزيئية:</td>
              <td> حذف</td>
            </tr>
          </thead>
          <tbody id="subchapter-table-body">
            <?php
            // Your existing PHP code for fetching sous chapitre will remain here
            $selectQuery5 = "SELECT * FROM sous_chapitre";
            $result5 = $conn->query($selectQuery5);
            if ($result5 && $result5->num_rows > 0) {
                while ($row = $result5->fetch_assoc()) {
                    ?>
                    <tr class="subchapter-row" data-chapitre="<?php echo $row['chapter_id']; ?>">
                        <td><?php echo $row['subchapter_name']; ?></td>
                        <td>
                        <a href="delete=<?php echo $row['subchapter_id']; ?>" onclick="return confirm('هل أنت متأكد من حذف هذه الوحدة التعلمية:')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'> لا توجد وحدة الجزيئية</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      
      <button type="submit" name="deletesub">حذف</button>
    </form>
  </div>
</div>


            <div id="DeleteCourModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeDeleteCourModal()">&times;</span>
                <h2>حذف عنوان درس</h2>
                
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch7" name="branch" required onchange="loadChapters7(this.value)">
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
                  <select id="chapter7" name="chapter" required onchange="loadSubchapters7(this.value)">
                  <option value="" disabled selected>اختر الوحدة التعليمية</option>
                 </select>
                 
  
                  <label for="subchapter">الوحدة الجزيئية: </label>
                  <select id="subchapter7" name="subchapter2" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                  </select>
  
                  <label for="unitName">الاسئلة المراد حذفها</label>
                  <div id="unitSelection">
                    <input type="checkbox" name="unit" value="وحدة 1">وحدة 1<br>
                    <input type="checkbox" name="unit" value="وحدة 2">وحدة 2<br>
                    <input type="checkbox" name="unit" value="وحدة 3">وحدة 3<br>
                    
                  </div>
                  <button type="submit">حذف</button>
                </form>
                 
              </div>
            </div>
  
             <!-- fenetre flottante eedit -->
        <div id="EditUnitModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeEditUnitModal()">&times;</span>
                <h2>تعديل وحدة تعليمية</h2>
                <form method="POST">
                  <label for="branch">الشعبة:</label>
                  <select id="branch4" name="branch2" required onchange="loadChapters4(this.value)">
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
                  <select id="chapter4" name="chapter2" required >
                  <option value="" disabled selected>اختر الوحدة التعليمية</option>
                 </select>
  
                  <label for="unitName">ادخل اسم الوحدة الجديدة :</label>
                  <input type="text" id="unitName" name="newchapter" required>
  
                  <button type="submit" name="updateChapter">تعديل</button>
                </form>
              </div>
            </div>
            <?php
// Check if the form has been submitted
if (isset($_POST['updateChapter'])) {
  // Get the updated chapter name and chapter ID from the form
  $newChapterName = $_POST['newchapter'];
  $chapterName = $_POST['chapter2'];
  $branchName= $_POST['branch2'];

  // Perform the database update to change the chapter name
  // Assuming you have already established a connection to the database

    // Update record in database
    $updateQuery = "UPDATE chapitre 
    INNER JOIN Filière ON chapitre.filiere_id = Filière.field_id
    SET chapitre.chapter_name = '$newChapterName' 
    WHERE chapitre.chapter_name = '$chapterName' AND Filière.field_name = '$branchName'";
    $results = mysqli_query($conn, $updateQuery);

    // Check if update was successful
    if (mysqli_affected_rows($conn) > 0) {
        
    echo "<script>alert('chapitre name update succesfuly');";
        exit;
    } else {
        // Display error message
        echo "Error updating record: " . mysqli_error($conn);
    }
  }
?>

            <div id="EditPartModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeEditPartModal()">&times;</span>
                <h2> تعديل وحدة جزئية</h2>
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch5" name="branch" required onchange="loadChapters6(this.value)">
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
                  <label for="branch">الوحدة التعلمية: </label>
                  <select id="chapter6" name="chapter" required onchange="loadSubchapters6(this.value)">
        <option value="" disabled selected>اختر الوحدة التعليمية</option>
      </select>
                  <label for="branch">الوحدة الجزيئية  المراد تعديلها</label>
                  <select id="subchapter6" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  <label for="unitName">  الوحدة الجزيئية  الجديدة </label>
                  <input type="text" id="unitName" name="unitName" required>
                  <button type="submit">تعديل</button>
                </form>
              </div>
            </div>
  
            <div id="EditCourModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeEditCourModal()">&times;</span>
                <h2>تعديل عنوان درس</h2>
                
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch8" name="branch" required onchange="loadChapters8(this.value)">
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
                  <select id="chapter8" name="chapter" required onchange="loadSubchapters8(this.value)">
                  <option value="" disabled selected>اختر الوحدة التعليمية</option>
                 </select>
                 
  
                  <label for="subchapter">الوحدة الجزيئية: </label>
                  <select id="subchapter8" name="subchapter2" required onchange="loadCours1(this.value)">
                   <option value="" disabled selected>اختر الوحدة الجزئية</option>
               </select>
                  <label >عنوان درس المراد تعديله</label>
                  <select id="cours1" name="cours" required>
                  <option value="" disabled selected>اختر درس</option>
               </select>
                  <label > العنوان درس  الجديد</label>
                  <input type="text" id="unitName" name="unitName" required>
                  <button type="submit">تعديل</button>
                </form>
              </div>
            
        </div>
 
      </div>
    </div>
     
</body>
   <script src="./assets/js/script.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script>
function loadChapters(branchId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var chapters = JSON.parse(this.responseText);
      var chapterSelect = document.getElementById('chapter');
      
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

  function loadChapters2(branchId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var chapters = JSON.parse(this.responseText);
      var chapterSelect = document.getElementById('chapter2');

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

function loadChapters3(branchId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var chapters = JSON.parse(this.responseText);
      var chapterSelect = document.getElementById('chapter-table-body');
      
      // Clear the chapter table body before populating
      chapterSelect.innerHTML = '';

      // Populate the chapter table with the filtered chapters
      for (var i = 0; i < chapters.length; i++) {
        var row = document.createElement('tr');
        row.setAttribute('class', 'chapter-row');
        row.setAttribute('data-filiere', chapters[i].filiere_id);

        var chapterNameCell = document.createElement('td');
        chapterNameCell.textContent = chapters[i].chapter_name;

        var deleteCell = document.createElement('td');
        var deleteLink = document.createElement('a');
        deleteLink.setAttribute('href', '?delete=' + chapters[i].chapter_id);
        deleteLink.setAttribute('onclick', "return confirm('هل أنت متأكد من حذف هذه الوحدة التعلمية:')");

        var deleteIcon = document.createElement('i');
        deleteIcon.setAttribute('class', 'fas fa-trash-alt');

        deleteLink.appendChild(deleteIcon);
        deleteCell.appendChild(deleteLink);

        row.appendChild(chapterNameCell);
        row.appendChild(deleteCell);
        chapterSelect.appendChild(row);
      }
    }
  };
  xhttp.open("GET", "get_chapters.php?branchId=" + branchId, true);
  xhttp.send();
} 

function loadChapters4(branchId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var chapters = JSON.parse(this.responseText);
      var chapterSelect = document.getElementById('chapter4');

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

function loadChapters5(branchId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var chapters = JSON.parse(this.responseText);
      var chapterSelect = document.getElementById('chapter5');

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

function loadChapters6(branchId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var chapters = JSON.parse(this.responseText);
      var chapterSelect = document.getElementById('chapter6');

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

  function loadSubchapters(chapitreId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var subchapters = JSON.parse(this.responseText);
      var subchapterSelect = document.getElementById('subchapter2');
      
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
function loadSubchapters5(chapitreId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var subchapters = JSON.parse(this.responseText);
      var subchapterSelect = document.getElementById('subchapter-table-body');
      
      // Clear the subchapter table body before populating
      subchapterSelect.innerHTML = '';

      // Populate the subchapter table with the filtered subchapters
      for (var i = 0; i < subchapters.length; i++) {
        var row = document.createElement('tr');
        row.setAttribute('class', 'subchapter-row');
        row.setAttribute('data-chapitre', subchapters[i].subchapter_id);

        var chapterNameCell = document.createElement('td');
        chapterNameCell.textContent = subchapters[i].subchapter_name;

        var deleteCell = document.createElement('td');
        var deleteLink = document.createElement('a');
        deleteLink.setAttribute('href', '?delete=' + subchapters[i].subchapter_id);
        deleteLink.setAttribute('onclick', "return confirm('هل أنت متأكد من حذف هذه الوحدة التعلمية:')");

        var deleteIcon = document.createElement('i');
        deleteIcon.setAttribute('class', 'fas fa-trash-alt');

        deleteLink.appendChild(deleteIcon);
        deleteCell.appendChild(deleteLink);

        row.appendChild(chapterNameCell);
        row.appendChild(deleteCell);
        subchapterSelect.appendChild(row);
      }
    }
  };
  xhttp.open("GET", "get_schapters.php?chapitreId=" + chapitreId, true);
  xhttp.send();
}
function loadSubchapters6(chapitreId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var subchapters = JSON.parse(this.responseText);
      var subchapterSelect = document.getElementById('subchapter6');
      
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
function loadSubchapters7(chapitreId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var subchapters = JSON.parse(this.responseText);
      var subchapterSelect = document.getElementById('subchapter7');
      
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
function loadSubchapters8(chapitreId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var subchapters = JSON.parse(this.responseText);
      var subchapterSelect = document.getElementById('subchapter8');
      
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


function loadChapters7(branchId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var chapters = JSON.parse(this.responseText);
      var chapterSelect = document.getElementById('chapter7');

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
function loadChapters8(branchId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var chapters = JSON.parse(this.responseText);
      var chapterSelect = document.getElementById('chapter8');

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

function loadCours1(subchapterId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var courses = JSON.parse(this.responseText);
      var coursSelect = document.getElementById('cours1');

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
  xhttp.open("GET", "get_cours.php?subchapterId=" + subchapterId, true);
  xhttp.send();
}
</script>
</html>
