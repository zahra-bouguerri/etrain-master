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
?>
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
            <label for="unitName">ادخل اسم الشعبة:</label><br /><br>
            <input type="text" id="unitName" name="branch" required><br /><br>
            <button type="submit" name="submit">إضافة</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./assets/js/script.js"></script>
</body>

</html>