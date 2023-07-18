<?php
include "./includes/header.php";
include "./includes/topmenu.php";
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
        // Fetch existing Filières from the database
        $fetchFiliereQuery = "SELECT * FROM Filière where year_id = 1";
        $fetchFiliereResult = $conn->query($fetchFiliereQuery);
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
<!-- ... -->

<div id="addPartModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeAddPartModal()">&times;</span>
    <h2>إضافة وحدة جزئية</h2>
    <form method="post">
      <label for="partBranch">الشعبة:</label>
      <select id="partBranch" name="partBranch" required>
        <option value="" disabled selected>اختر الشعبة</option>
        <?php
        // Fetch existing Filières from the database for addPartModal
        $fetchFiliereQueryPart = "SELECT * FROM Filière WHERE year_id = 1";
        $fetchFiliereResultPart = $conn->query($fetchFiliereQueryPart);

        // Populate the select options with existing Filières
        if ($fetchFiliereResultPart->num_rows > 0) {
          while ($row = $fetchFiliereResultPart->fetch_assoc()) {
            echo "<option value='" . $row['field_id'] . "'>" . $row['field_name'] . "</option>";
          }
        }
        ?>
      </select><br>

      <label for="partChapitre">الوحدة التعلمية:</label>
      <select id="partChapitre" name="partChapitre" required>
        <option value="" disabled selected>اختر الوحدة</option>
        <?php
        if (isset($_POST['partBranch'])) {
          $selectedFiliere = $_POST['partBranch'];

          // Fetch chapitres for the selected filière
          $fetchChapitreQuery = "SELECT chapter_name 
                                 FROM chapitre 
                                 WHERE filiere_id = ?";
          $stmt = $conn->prepare($fetchChapitreQuery);

          if ($stmt) {
            // Bind the parameter
            $stmt->bind_param("s", $selectedFiliere);

            // Execute the statement
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Fetch chapitres and populate the select options
            if ($result->num_rows > 0) {
              while ($chapitreRow = $result->fetch_assoc()) {
                echo "<option value='" . $chapitreRow['chapter_name'] . "'>" . $chapitreRow['chapter_name'] . "</option>";
              }
            }

            // Close the statement
            $stmt->close();
          }
        }
        ?>
      </select>

      <br>
      <label for="unitName"> الوحدة الجزيئية  </label>
      <input type="text" id="unitName" name="sousUnite" required><br>
      <button type="submit" name="addSous">إضافة</button>
    </form>
  </div>
</div>

<!-- ... -->

            <?php
if (isset($_POST['addSous'])) {
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
            <div id="addCourModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeAddCourModal()">&times;</span>
                <h2>إضافة درس</h2>
                <form>
  
                  <label for="branch">الوحدة الجزيئية : </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
  
                  <label for="unitName"> اضافة درس</label>
                  <input type="text" id="unitName" name="unitName" required>
                  <button type="submit">إضافة</button>
                </form>
              </div>
            </div>

            <!-- fenetre flottante delete -->
            <div id="DeleteUnitModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeDeleteUnitModal()">&times;</span>
                <h2>حذف وحدة تعليمية</h2>
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الشعبة</option>
                    <option value="علوم تجريبية">علوم تجريبية</option>
                    <option value="اداب">اداب</option>
                  </select>
                  <label for="unitName">اختر الوحدات المراد حذفها</label>
                  <div id="unitSelection">
                    <input type="checkbox" name="unit" value="وحدة 1">وحدة 1<br>
                    <input type="checkbox" name="unit" value="وحدة 2">وحدة 2<br>
                    <input type="checkbox" name="unit" value="وحدة 3">وحدة 3<br>
                    
                  </div>
                  <button type="submit">حذف</button>
                </form>
              </div>
            </div>
  
            <div id="DeletePartModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeDeletePartModal()">&times;</span>
                <h2> حذف وحدة جزئية</h2>
                <form>

                  <label for="branch">الوحدة التعلمية: </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة التعليمية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  <label for="branch">الوحدة الجزيئية  المراد حذفها</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  
                  <button type="submit">حذف</button>
                </form>
              </div>
            </div>

            <div id="DeleteCourModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeDeleteCourModal()">&times;</span>
                <h2>حذف درس</h2>
                
                <form>

  
                  <label for="branch">لوحدة الجزيئية : </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  <label for="unitName">الدروس المراد حذفها</label>
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
       <form method="post">
                <label for="branch">الشعبة:</label><br>
                    <select id="branch" name="editBranch" required>
                  <option value="" disabled selected>اختر الشعبة</option>
                  <?php
        // Fetch existing Filières from the database for addPartModal
        $fetchFiliereQueryPart = "SELECT * FROM Filière where year_id = 1";
        $fetchFiliereResultPart = $conn->query($fetchFiliereQueryPart);

        // Populate the select options with existing Filières
        if ($fetchFiliereResultPart->num_rows > 0) {
          while ($row = $fetchFiliereResultPart->fetch_assoc()) {
            echo "<option value='" . $row['field_id'] . "'>" . $row['field_name'] . "</option>";
          }
        }
        ?>
      </select><br>
      <label for="editUnit">اختر اسم الوحدة المراد تعديلها:</label>
      <select id="editUnit" name="editUnit" required>
        <option value="" disabled selected>اختر الوحدة</option>
        
      </select>

      <label for="newUnitName">ادخل اسم الوحدة الجديدة :</label>
      <input type="text" id="newUnitName" name="newUnitName" required>

      <button type="submit" name="Edit">تعديل</button>
    </form>
  </div>
</div>

<?php
if (isset($_POST['Edit'])) {
  $branch = $_POST['editBranch'];
  $selectedUnit = $_POST['editUnit'];
  $newUnitName = $_POST['newUnitName'];

  // Update the selected chapitre for the filiere
  $updateQuery = "UPDATE Chapitre SET chapter_name = '$newUnitName' WHERE filiere_id = '$branch' AND chapter_name = '$selectedUnit'";
  if ($conn->query($updateQuery) === TRUE) {
    echo "<script>alert('تم تعديل الوحدة التعليمية بنجاح.');</script>";
  } else {
    echo "Error: ";
  }
}
?>
  
            <div id="EditPartModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeEditPartModal()">&times;</span>
                <h2> تعديل وحدة جزئية</h2>
                <form>

                  <label for="branch">الوحدة التعلمية: </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة التعليمية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  <label for="branch">الوحدة الجزيئية  المراد تعديلها</label>
                  <select id="branch" name="branch" required>
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
                <h2>تعديل درس</h2>
                
                <form>
  
                  <label for="branch">لوحدة الجزيئية : </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  <label for="unitName">عنوان درس المراد تعديله</label>
                  <div id="unitSelection">
                    <input type="checkbox" name="unit" value="وحدة 1">وحدة 1<br>
                    <input type="checkbox" name="unit" value="وحدة 2">وحدة 2<br>
                    <input type="checkbox" name="unit" value="وحدة 3">وحدة 3<br>
                    
                  </div>
                  <label for="unitName"> عنوان درس  الجديد</label>
                  <input type="text" id="unitName" name="unitName" required>
                  <button type="submit">تعديل</button>
                </form>
                 
              </div>
            
        </div>
         <div class="projects p-20 bg-white rad-10 m-20">
        <h2 class="mt-0 mb-20">منهج الرياضيات الخاص بالسنة اولى ثانوي علمي</h2>
        <div class="responsive-table">
          <table class="fs-15 w-full">
            <thead>
              <tr>
                <td>الوحدات التعليمية</td>
                <td>الوحدات الجزئية</td>
                <td>الدروس</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td rowspan="3">الوحدة التعلمية الاولى</td>
                <td>الوحدة الجزئية الاولى</td>
                <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
              </tr>
              <tr>
                <td>الوحدة الجزئية الثانية</td>
                <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
              </tr>
              <tr>
                <td>الوحدة الجزئية الثالثة</td>
                <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
              </tr>
              <tr>
                <td rowspan="3">الوحدة التعلمية الثانية</td>
                <td>الوحدة الجزئية الاولى</td>
                <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
              </tr>
              <tr>
                <td>الوحدة الجزئية الثانية</td>
                <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
              </tr>
              <tr>
                <td>الوحدة الجزئية الثالثة</td>
                <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
              </tr>
              <tr>
                <td rowspan="3">الوحدة التعلمية الثالثة</td>
                <td>الوحدة الجزئية الاولى</td>
                <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
              </tr>
              <tr>
                <td>الوحدة الجزئية الثانية</td>
                <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
              </tr>
              <tr>
                <td>الوحدة الجزئية الثالثة</td>
                <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
              </tr>
            </tbody>
          </table>
          
        </div>
        </div>
      

      </div>
     
    </div>
    
  
        <!-- End Head -->

  </body>

   <script src="./assets/js/script.js"></script>
  
</html>
