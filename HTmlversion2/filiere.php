<?php
include "./includes/header.php";

if (isset($_POST['submit'])) {
    $branch = $_POST['branch'];
    $annee = $_POST['annee'];

    // Get the year_id for the selected year
    $yearIdQuery = "SELECT year_id FROM Année WHERE year_name = '$annee'";
    $yearIdResult = $conn->query($yearIdQuery);

    if ($yearIdResult->num_rows == 1) {
        $yearIdRow = $yearIdResult->fetch_assoc();
        $yearId = $yearIdRow['year_id'];

        // Check if the Filière already exists
        $filiereExistsQuery = "SELECT * FROM Filière WHERE field_name = '$branch' AND year_id = '$yearId'";
        $filiereExistsResult = $conn->query($filiereExistsQuery);

        if ($filiereExistsResult->num_rows > 0) {
            echo "<script>alert('الشعبة موجودة بالفعل في هذا العام.');</script>";
        } else {
            // Insert the new record into the Filière table
            $insertQuery = "INSERT INTO Filière (field_name, year_id) VALUES ('$branch', '$yearId')";
            if ($conn->query($insertQuery) === TRUE) {
                echo "<script>alert('تمت إضافة شعبة جديدة بنجاح.');</script>";
            } else {
                echo "Error: ";
            }
        }
    } else {
        echo "<script>alert('العام المحدد غير موجود.');</script>";
    }
}

if (isset($_GET['delete'])) {
    $field_id = $_GET['delete'];
    // Use prepared statement with a placeholder for the id value
    $deleteSql = "DELETE FROM Filière WHERE field_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("s", $field_id); // Bind the integer value to the placeholder
    $deleteResult = $stmt->execute(); // Execute the prepared statement

    // Check if the deletion was successful
    if ($deleteResult) {
        echo "<script>alert('تم حذف الشعبة بنجاح.');</script>";
        // Redirect to the same page to update the table
        echo "<script>window.location.href = 'filiere.php';</script>";
    } else {
        echo "<script>alert('حدث خطأ أثناء حذف الشعبة.');</script>";
    }
}
// Fetch data for the table
$selectQuery = "SELECT * FROM Filière";
$result = $conn->query($selectQuery);
?>
<div class="top-menu">
          <ul>
            <li>
              <a href="#"> الشعب</a>
              <ul class="sub-menu-wide">
                <li><a href="#" onclick="showDeleteUnitForm()">حذف شعبة  </a></li>
              </ul>
            </li>
            </ul>
        </div>
<div class="content w-full">
    <div class="projects p-20 bg-white rad-10 m-20">
        <h2 class="mt-0 mb-20">ادارة الشعب</h2>
        <form action="filiere.php" method="POST">
            <select class="select-field" name="annee">
                <option value="">اختر السنة</option>
                <option value="الاولى ثانوي">الاولى ثانوي</option>
                <option value="الثانية ثانوي">الثانية ثانوي</option>
                <option value="الثالثة ثانوي">الثالثة ثانوي</option>
            </select>
            <label for="unitName">ادخل اسم الشعبة:</label>
            <input type="text" id="unitName" name="branch" required><br /><br>
            <button type="submit" name="submit">إضافة</button>
        </form>
    </div>
</div>
  <!-- fenetre flottante delete -->
  <div id="DeleteUnitModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeDeleteUnitModal()">&times;</span>
                <h2>حذف  شعبة</h2>
                <form>
                  <label for="branch">الشعبة:</label>
                  <div class="responsive-table">
            <table class="fs-15 w-full">
              <thead>
                <tr>
                  <td>اسم الشعبة</td>
                  <td> حذف</td>
                </tr>
              </thead>
              <tbody>
              <?php
           if ($result && $result->num_rows > 0) { // Check if query result is valid
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['field_name']; ?></td>
                    <td>
                        <a href="?delete=<?php echo $row['field_id']; ?>" onclick="return confirm('هل أنت متأكد من حذف هذه الشعبة؟')">
                        <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='6'>لا توجد شعب تم العثور عليها</td></tr>";
        }
            ?>
              </tbody>
            </table>
          </div>
                    
                  </div>

                </form>
              </div>
            </div>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./assets/js/script.js"></script>
</body>

</html>