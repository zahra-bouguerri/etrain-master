
<?php
include "./includes/header.php";
include "./includes/topmenu.php";

// Fetch existing Filières from the database
$fetchFiliereQuery = "SELECT * FROM Filière where year_id = 3";
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
        $sql = "SELECT field_name, field_id FROM Filière where year_id=3";
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
        $sql = "SELECT field_name, field_id FROM Filière where year_id=3";
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

<!-- fenetre flottante delete -->
    <div id="DeleteUnitModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteUnitModal()">&times;</span>
        <h2>حذف الوحدة التعلمية:</h2>
        <form id="deleteUnitForm" method="post">
            <label for="branch">الشعبة:</label><br>
            <select id="branch3" name="branch" required onchange="loadChapters3(this.value)">
            <option value="" disabled selected>اختر الشعبة</option>
            <?php
              // Exécutez la requête SQL pour sélectionner les noms des filières
              $sql = "SELECT field_name, field_id FROM Filière where year_id=3";
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
    
            </select><br>

            <label for="unitName">اختر الوحدات التعليمية المراد حذفها </label>
            <div id="sequenceSelection" >
               <!-- Les cases à cocher seront générées dynamiquement en JavaScript -->
            </div>

              
      <button type="submit" name="supprimerSequence">حذف</button>
        </form>
    </div>
</div>


<?php
if (isset($_POST['supprimerSequence'])) {
// Vérifier si des subchapitre  ont été sélectionnés pour la suppression
if (isset($_POST['sequencesToDelete']) && is_array($_POST['sequencesToDelete'])) {
  // Récupérer les ID des cours sélectionnés pour la suppression
  $sequencesToDelete = $_POST['sequencesToDelete'];

  // Vérifier s'il existe des enregistrements liés dans les autres tables
  $linkedRecords = array();
  foreach ($sequencesToDelete as $sequenceId) {
    $checkLinkedQuery = "SELECT * FROM sous_chapitre  WHERE chapter_id = '$sequenceId' LIMIT 1";
    $linkedResult = $conn->query($checkLinkedQuery);
    if ($linkedResult->num_rows > 0) {
      $linkedRecords[] = $sequenceId;
    }
    // Vérifiez également les autres tables liées ici et ajoutez les ID de cours liés à $linkedRecords si nécessaire
  }

  if (!empty($linkedRecords)) {
    // Certains cours ont des enregistrements liés, affichez le message d'erreur
    $sequencesList = implode(", ", $linkedRecords);
     echo "<script>alert(' لا يمكن حذف الوحدة لاانها تحتوي على وحدات جزئية يرجى حذفهم اولا');</script>";
  } else {
    // Aucun enregistrement lié trouvé, procédez à la suppression des cours
    $sequenceIds = implode("','", $sequencesToDelete);
    $deletesequencesQuery = "DELETE FROM chapitre WHERE chapter_id IN ('$sequenceIds')";
    if ($conn->query($deletesequencesQuery)) {
      echo "<script>alert('تم حذف الوحدات بنجاح.');</script>";
    } else {
      echo "Error: " . $conn->error;
    }
  }
} else {
  echo "<script>alert('يرجى تحديد الوحدات التي تريد حذفها.');</script>";
}
}
?>







         <!--end delete chapitre-->
  
<div id="DeletePartModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeDeletePartModal()">&times;</span>
    <h2> حذف وحدة جزئية</h2>
    <form id="DeleteSubChap" method="post">
      <label for="branch">الشعبة:</label>
      <select id="branch6" name="branch" required onchange="loadChapters5(this.value)">
        <option value="" disabled selected>اختر الشعبة</option>
        <?php
        // Exécutez la requête SQL pour sélectionner les noms des filières
        $sql = "SELECT field_name, field_id FROM Filière where year_id=3";
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
      <label for="unitName">اختر الوحدات الجزئية المراد حذفها </label>
      <div id="subChapSelection" >
        <!-- Les cases à cocher seront générées dynamiquement en JavaScript -->
      </div>
    
           
            
      
      <button type="submit" name="deletesub">حذف</button>
    </form>
  </div>
</div>
<?php
if (isset($_POST['deletesub'])) {
  // Vérifier si des subchapitre  ont été sélectionnés pour la suppression
  if (isset($_POST['subchaptersToDelete']) && is_array($_POST['subchaptersToDelete'])) {
    // Récupérer les ID des cours sélectionnés pour la suppression
    $subchaptersToDelete = $_POST['subchaptersToDelete'];

    // Vérifier s'il existe des enregistrements liés dans les autres tables
    $linkedRecords = array();
    foreach ($subchaptersToDelete as $subchapterId) {
      $checkLinkedQuery = "SELECT * FROM cours  WHERE subchapter_id = '$subchapterId' LIMIT 1";
      $linkedResult = $conn->query($checkLinkedQuery);
      if ($linkedResult->num_rows > 0) {
        $linkedRecords[] = $subchapterId;
      }
      // Vérifiez également les autres tables liées ici et ajoutez les ID de cours liés à $linkedRecords si nécessaire
    }
  
    if (!empty($linkedRecords)) {
      // Certains cours ont des enregistrements liés, affichez le message d'erreur
      $subchaptersList = implode(", ", $linkedRecords);
       echo "<script>alert(' لا يمكن حذف الوحدة لاانها تحتوي على دروس يرجى حذفهم اولا');</script>";
    } else {
      // Aucun enregistrement lié trouvé, procédez à la suppression des cours
      $subchapterIds = implode("','", $subchaptersToDelete);
      $deletesubchaptersQuery = "DELETE FROM sous_chapitre WHERE subchapter_id IN ('$subchapterIds')";
      if ($conn->query($deletesubchaptersQuery)) {
        echo "<script>alert('تم حذف الوحدات بنجاح.');</script>";
      } else {
        echo "Error: " . $conn->error;
      }
    }
  } else {
    echo "<script>alert('يرجى تحديد الوحدات التي تريد حذفها.');</script>";
  }
}
?>




<div id="DeleteCourModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeDeleteCourModal()">&times;</span>
    <h2>حذف عنوان درس</h2>
    
    <form id="deleteCourseForm" method="post">
      <label for="branch">الشعبة:</label>
      <select id="branch7" name="branch" required onchange="loadChapters7(this.value)">
        <option value="" disabled selected>اختر الشعبة</option>
        <?php
        // Exécutez la requête SQL pour sélectionner les noms des filières
        $sql = "SELECT field_name, field_id FROM Filière where year_id=3";
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
      <select id="subchapter7" name="subchapter2" required onchange=" loadCours1(this.value)">
        <option value="" disabled selected>اختر الوحدة الجزئية</option>
      </select>

      <label for="unitName">الدروس المراد حذفها</label>
      <div id="unitSelection" >
        <!-- Les cases à cocher seront générées dynamiquement en JavaScript -->
      </div>
      <button type="submit" name ="supprimerLecon">حذف</button>
    </form>
  </div>
</div>
<?php
if (isset($_POST['supprimerLecon'])) {
  // Vérifier si des cours ont été sélectionnés pour la suppression
  if (isset($_POST['coursesToDelete']) && is_array($_POST['coursesToDelete'])) {
    // Récupérer les ID des cours sélectionnés pour la suppression
    $coursesToDelete = $_POST['coursesToDelete'];

    // Vérifier s'il existe des enregistrements liés dans les autres tables
    $linkedRecords = array();
    foreach ($coursesToDelete as $courseId) {
      $checkLinkedQuery = "SELECT * FROM quiz WHERE course_id = '$courseId' LIMIT 1";
      $linkedResult = $conn->query($checkLinkedQuery);
      if ($linkedResult->num_rows > 0) {
        $linkedRecords[] = $courseId;
      }
      // Vérifiez également les autres tables liées ici et ajoutez les ID de cours liés à $linkedRecords si nécessaire
    }

    if (!empty($linkedRecords)) {
      // Certains cours ont des enregistrements liés, affichez le message d'erreur
      $coursesList = implode(", ", $linkedRecords);
      echo "<script>alert('لا يمكن حذف الدروس التالية لأنها تحتوي على تقويمات أو فيديوهات أو ملفات PDF: $coursesList. يرجى حذفهم أولاً.');</script>";
    } else {
      // Aucun enregistrement lié trouvé, procédez à la suppression des cours
      $courseIds = implode("','", $coursesToDelete);
      $deleteCoursesQuery = "DELETE FROM cours WHERE course_id IN ('$courseIds')";
      if ($conn->query($deleteCoursesQuery)) {
        echo "<script>alert('تم حذف الدروس بنجاح.');</script>";
      } else {
        echo "Error: " . $conn->error;
      }
    }
  } else {
    echo "<script>alert('يرجى تحديد الدروس التي تريد حذفها.');</script>";
  }
}
?>



<div id="EditUnitModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeEditUnitModal()">&times;</span>
                <h2>تعديل وحدة تعليمية</h2>
                <form id= "EditSeqForm" method="post">
                  <label for="branch">الشعبة:</label>
                  <select id="branch4" name="branch2" required onchange="loadChapters6(this.value)">
                  <option value="" disabled selected>اختر الشعبة</option>
        <?php
        // Exécutez la requête SQL pour sélectionner les noms des filières
        $sql = "SELECT field_name, field_id FROM Filière where year_id=3";
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
                  <select id="chapter6" name="chapter" required >
                  <option value="" disabled selected>    اختر الوحدة التعليمية المراد تعديلها</option>
                </select>
                  
                  <label for="unitName">  الوحدة التعليمية  الجديدة </label>
                  <input type="text" id="unitName" name="unitName" >
                  <label for="cours"> حالة  </label>
                <select name="etat" class="niveau" >
                  <option value=""> --اختر--</option>
                  <option value=""> <option>
                 <option value=" جديد"> جديد</option>
                </select>
                  <button type="submit" name ="modifiersequence">تعديل</button>
                 
                </form>
              </div>
            </div>
            <?php
// Assurez-vous que vous avez une connexion à la base de données établie avant cette partie du code.

if (isset($_POST['modifiersequence'])) {
    // Récupérer les valeurs des champs du formulaire
    $branchId = $_POST['branch2'];
    $chapterId = $_POST['chapter'];
    $newSubchapterName = $_POST['unitName'];
    $newEtat = $_POST['etat'];

    // Vérifier si la sous-unité existe déjà dans la base de données pour cette branche et ce chapitre
    $checkQuery = "SELECT * FROM chapitre WHERE chapter_name = '$newSubchapterName'  AND chapter_id = '$branchId'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('هذه الوحدة التعليمية موجودة بالفعل في الشعبة والوحدة التعلمية المحددة.');</script>";
      } else {
        // Construire la requête de mise à jour pour inclure uniquement les champs modifiés
        $updateQuery = "UPDATE chapitre SET";

        // Si un nouveau nom de sous-unité a été fourni, inclure le champ name dans la requête de mise à jour
        if (!empty($newSubchapterName)) {
            $updateQuery .= " chapter_name = '$newSubchapterName',";
        }

        // Vérifier si un nouvel état a été fourni ou si l'option "vide" a été sélectionnée
        if ($newEtat !== 'vide') {
            // Inclure le champ etat dans la requête de mise à jour
            $updateQuery .= " etat = '$newEtat',";
        } else {
            // Sinon, mettre le champ etat à une valeur vide ou null dans la base de données (selon le schéma de la base de données)
            $updateQuery .= " etat = '',"; // or $updateQuery .= " etat = NULL,"; if your schema allows NULL values
        }

        // Supprimer la dernière virgule dans la requête de mise à jour
        $updateQuery = rtrim($updateQuery, ',');

        // Ajouter la condition WHERE pour mettre à jour uniquement le chapitre spécifié
        $updateQuery .= " WHERE chapter_id = '$chapterId'";

        // Exécuter la requête de mise à jour
        if ($conn->query($updateQuery) === TRUE) {
            echo "<script>alert('تم تعديل الوحدة الجزئية بنجاح.');</script>";
            header("Location: index.php"); // Redirect to index.php after successful update
            exit(); 
          } else {
            echo "Erreur : " . $conn->error;
        }
    }
}

?>



   <div id="EditPartModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeEditPartModal()">&times;</span>
                <h2> تعديل وحدة جزئية</h2>
                <form id="editPartForm" method="post">
                  <label for="branch">الشعبة:</label>
                  <select id="branch5" name="branch" required onchange="loadChapters6(this.value)">
                  <option value="" disabled selected>اختر الشعبة</option>
        <?php
        // Exécutez la requête SQL pour sélectionner les noms des filières
        $sql = "SELECT field_name, field_id FROM Filière where year_id=3";
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
                  <select id="subchapter6" name="subchapter" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                
                  </select>
                  <label for="unitName">  الوحدة الجزيئية  الجديدة </label>
                  <input type="text" id="unitName" name="unitName" >
                 
                  <button type="submit" name ="modifierSequence">تعديل</button>
                </form>
              </div>
            </div>
            <?php
// Assurez-vous que vous avez une connexion à la base de données établie avant cette partie du code.

if (isset($_POST['modifierSequence'])) {
    // Récupérer les valeurs des champs du formulaire
    $branchId = $_POST['branch'];
    $chapterId = $_POST['chapter'];
    $subchapterId = $_POST['subchapter'];
    $newSubchapterName = $_POST['unitName'];
  

    // Vérifier si la sous-unité existe déjà dans la base de données pour cette branche et ce chapitre
    $checkQuery = "SELECT * FROM sous_chapitre WHERE subchapter_name = '$newSubchapterName' AND chapter_id = '$chapterId'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('هذه الوحدة الجزئية موجودة بالفعل في الشعبة والوحدة التعلمية المحددة.');</script>";
    } else {
        // Construire la requête de mise à jour pour inclure uniquement les champs modifiés
        $updateQuery = "UPDATE sous_chapitre SET";

        // Si un nouveau nom de sous-unité a été fourni, inclure le champ subchapter_name dans la requête de mise à jour
        if (!empty($newSubchapterName)) {
            $updateQuery .= " subchapter_name = '$newSubchapterName',";
        }

      

        // Supprimer la dernière virgule dans la requête de mise à jour
        $updateQuery = rtrim($updateQuery, ',');

        // Ajouter la condition WHERE pour mettre à jour uniquement le sous-chapitre spécifié
        $updateQuery .= " WHERE subchapter_id = '$subchapterId'";

        // Exécuter la requête de mise à jour
        if ($conn->query($updateQuery) === TRUE) {
            echo "<script>alert('تم تعديل الوحدة الجزئية بنجاح.');</script>";
            header("Location: index.php"); // Redirect to index.php after successful update
            exit(); 
          } else {
            echo "Erreur : " . $conn->error;
        }
    }
}
       
      
?>











            <div id="EditCourModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeEditCourModal()">&times;</span>
                <h2>تعديل عنوان درس</h2>
                
                <form id="editModelForm" method="post">
                  <label for="branch">الشعبة:</label>
                  <select id="branch8" name="branch" required onchange="loadChapters8(this.value)">
                  <option value="" disabled selected>اختر الشعبة</option>
        <?php
        // Exécutez la requête SQL pour sélectionner les noms des filières
        $sql = "SELECT field_name, field_id FROM Filière where year_id=3";
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
                  <select id="subchapter8" name="subchapter2" required onchange="loadCours2(this.value)">
                   <option value="" disabled selected>اختر الوحدة الجزئية</option>
               </select>
                  <label >عنوان الدرس المراد تعديله</label>
                  <select id="coursUpdate" name="cours" required>
                  <option value="" disabled selected>اختر درس</option>
               </select>
                  <label > عنوان الدرس  الجديد</label>
                  <input type="text" id="unitName" name="unitName" >
                  <label for="cours"> حالة  </label>
                <select name="etat" class="niveau" >
                  <option value=""> --اختر--</option>
                  <option value=""> <option>
                 <option value=" جديد"> جديد</option>
                </select>
                  <button type="submit" name="modifiercour">تعديل</button>
                </form>
              </div>
            
        </div>
 
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
      </div>
    </div>
    <!-- PHP -->
<?php
if (isset($_POST['modifiercour'])) {
  $selectedCoursId = $_POST['cours'];
  $newCoursTitle = $_POST['unitName'];
  $newEtat = $_POST['etat'];

  // Vérifier si le titre du cours existe déjà pour un autre cours
  $checkQuery = "SELECT * FROM cours WHERE course_name = '$newCoursTitle' AND course_id != '$selectedCoursId'";
  $checkResult = $conn->query($checkQuery);

  if ($checkResult->num_rows > 0) {
      echo "<script>alert('عفوًا ، يوجد بالفعل درس آخر بنفس العنوان. الرجاء اختيار عنوان جديد.');</script>";
  } else {
      // Construire la requête de mise à jour pour inclure uniquement les champs modifiés
      $updateQuery = "UPDATE cours SET";

      // Si un nouveau titre de cours a été fourni, inclure le champ course_name dans la requête de mise à jour
      if (!empty($newCoursTitle)) {
          $updateQuery .= " course_name = '$newCoursTitle',";
      }

      // Vérifier si un nouvel état a été fourni ou si l'option "vide" a été sélectionnée
      if ($newEtat !== 'vide') {
        // Inclure le champ etat dans la requête de mise à jour
        $updateQuery .= " etat = '$newEtat',";
    } else {
        // Sinon, mettre le champ etat à une valeur vide ou null dans la base de données (selon le schéma de la base de données)
        $updateQuery .= " etat = '',"; // or $updateQuery .= " etat = NULL,"; if your schema allows NULL values
    }

      // Supprimer la dernière virgule dans la requête de mise à jour
      $updateQuery = rtrim($updateQuery, ',');

      // Ajouter la condition WHERE pour mettre à jour uniquement le cours spécifié
      $updateQuery .= " WHERE course_id = '$selectedCoursId'";

      // Exécuter la requête de mise à jour
      if ($conn->query($updateQuery) === TRUE) {
          echo "<script>alert('تم تعديل عنوان الدرس بنجاح.');</script>";
          header("Location: index.php"); // Redirect to index.php after successful update
          exit(); 
      } else {
          echo "Erreur : " . $conn->error;
      }
  }
}
?>


     
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
      var sequenceSelection = document.getElementById('sequenceSelection');

      // Clear previous checkboxes
      sequenceSelection.innerHTML = '';

      // Generate checkboxes for the chapters
      for (var i = 0; i < chapters.length; i++) {
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'sequencesToDelete[]'; // The name with [] allows sending as an array in POST
        checkbox.value = chapters[i].chapter_id;
        checkbox.id = 'sequence_' + chapters[i].chapter_id;

        var label = document.createElement('label');
        label.innerHTML = chapters[i].chapter_name;
        label.setAttribute('for', 'sequence_' + chapters[i].chapter_id);

        sequenceSelection.appendChild(checkbox);
        sequenceSelection.appendChild(label);
        sequenceSelection.appendChild(document.createElement('br'));
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
      var subChapSelection = document.getElementById('subChapSelection');

      // Clear the previous checkboxes before populating
      subChapSelection.innerHTML = '';

      // Populate the div with the checkboxes for the subchapters
      for (var i = 0; i < subchapters.length; i++) {
        var subchapter = subchapters[i];

        // Create a new checkbox for each subchapter
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'subchaptersToDelete[]';
        checkbox.value = subchapter.subchapter_id;
        checkbox.id = 'subchapter' + subchapter.subchapter_id;

        // Create a label for the checkbox
        var label = document.createElement('label');
        label.htmlFor = 'subchapter' + subchapter.subchapter_id;
        label.textContent = subchapter.subchapter_name;

        // Append the checkbox and the label to the div
        subChapSelection.appendChild(checkbox);
        subChapSelection.appendChild(label);
        subChapSelection.appendChild(document.createElement('br')); // Line break for spacing
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

      // Once the subchapters are loaded, load the corresponding courses for the selected subchapter
      var selectedSubchapterId = subchapterSelect.value;
      loadCours2(selectedSubchapterId);
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
      var unitSelection = document.getElementById('unitSelection');

      // Clear previous checkboxes
      unitSelection.innerHTML = '';

      // Generate checkboxes for the courses
      for (var i = 0; i < courses.length; i++) {
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'coursesToDelete[]'; // The name with [] allows sending as an array in POST
        checkbox.value = courses[i].course_id;
        checkbox.id = 'course_' + courses[i].course_id;

        var label = document.createElement('label');
        label.innerHTML = courses[i].course_name;
        label.setAttribute('for', 'course_' + courses[i].course_id);

        unitSelection.appendChild(checkbox);
        unitSelection.appendChild(label);
        unitSelection.appendChild(document.createElement('br'));
      }
    }
  };
  xhttp.open("GET", "get_cours.php?subchapterId=" + subchapterId, true);
  xhttp.send();
}

function loadCours2(subchapterId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var courses = JSON.parse(this.responseText);
      var coursSelect = document.getElementById('coursUpdate');

      // Clear the select options before populating
      coursSelect.innerHTML = '';

      // Add the initial empty and disabled option
      var initialOption = document.createElement('option');
      initialOption.value = "";
      initialOption.disabled = true;
      initialOption.selected = true;
      initialOption.textContent = "اختر درس";
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
</html>
