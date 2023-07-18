<?php
include "./includes/header.php";


// Fetch the student data from the database, sorted by 'سنة التسجيل' in ascending order
$query = "SELECT * FROM étudiant ORDER BY `anneereg` ASC";
$result = $conn->query($query);

if (isset($_GET['delete'])) {
  $field_id = $_GET['delete'];
  // Use prepared statement with a placeholder for the id value
  $deleteSql = "DELETE FROM étudiant WHERE email = ?";
  $stmt = $conn->prepare($deleteSql);
  $stmt->bind_param("s", $field_id); // Bind the integer value to the placeholder
  $deleteResult = $stmt->execute(); // Execute the prepared statement

  // Check if the deletion was successful
  if ($deleteResult) {
      echo "<script>alert('تم حذف التلميذ بنجاح.');</script>";
      // Redirect to the same page to update the table
      echo "<script>window.location.href = 'filiere.php';</script>";
  } else {
      echo "<script>alert('حدث خطأ أثناء حذف التلميذ.');</script>";
  }
}
?>
 <!-- FIRST CASE-->
        <h1 class="p-relative"> قائمة التلاميذ</h1>
         <div class="projects p-20 bg-white rad-10 m-20">
        
          <div class="responsive-table">
            <table class="fs-15 w-full">
              <thead>
                <tr>
                <td>البريد الالكتروني</td>
                  <td>الاسم</td>
                  <td>اللقب</td>
                  <td> السنة الدراسية</td>
                  <td>سنة التسجيل</td>
                  <td> حذف</td>
                </tr>
              </thead>
              <tbody>
              <?php
        // Loop through each row of the result set and display the data in the table
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['prenom'] . "</td>";
            echo "<td>" . $row['annee'] . "</td>";
            echo "<td>" . $row['anneereg'] . "</td>";
            echo "<td>
            <a href='?delete=" . $row['email'] . "' onclick=\"return confirm('هل أنت متأكد من حذف هذا التلميذ ؟')\">
            <i class='fas fa-trash-alt'></i>
            </a>
        </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='4'>لا يوجد بيانات متاحة</td></tr>";
        }
        ?>
              </tbody>
            </table>
          </div>
        </div>
              </div>
          <!--END 2 EME LIGNE -->
        </div>
      </div>
    </div>
  </body>
  <script src="./assets/js/script.js"></script>
</html>
<!-- Start latest uploads-->

</div>
