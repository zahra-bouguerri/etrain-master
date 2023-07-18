<?php
include "./includes/header.php";

$successMessage = "";

if(isset($_POST['updateEmail'])) {
  $newEmail = $_POST['newEmail'];

  // Perform the email update query
  $updateEmailQuery = "UPDATE admin SET email = '$newEmail' WHERE admin_id = 1";
  if ($conn->query($updateEmailQuery)) {
   echo "<script>alert('تم تحديث البريد الإلكتروني بنجاح.')";
  } else {
    echo "<script>alert('حدث خطأ أثناء تحديث البريد الإلكتروني.')";
  }
}

if(isset($_POST['updatePassword'])) {
  $oldPassword = $_POST['oldPassword'];
  $newPassword = $_POST['newPassword'];

  // Perform the password update query
  $updatePasswordQuery = "UPDATE admin SET motPass = '$newPassword' WHERE admin_id = 1";
  if ($conn->query($updatePasswordQuery)) {
    echo "<script>alert('تم تحديث كلمة المرور بنجاح.')";
  } else {
    echo "<script>alert('حدث خطأ أثناء تحديث كلمة المرور.')";
  }
}

?>

<div class="content w-full">
  <div class="projects p-20 bg-white rad-10 m-20">
    <h2 class="mt-0 mb-20">ادارة الحساب</h2>
    <form method="POST">
      <h4 class="mt-0 mb-20">ادارة البريد الالكتروني</h4>
      <label for="newEmail">ادخل اسم البريد الالكتروني الجديد:</label>
      <input type="email" id="newEmail" name="newEmail" ><br /><br>
      <button type="submit" name="updateEmail">تغيير</button><br>

      <h4 class="mt-0 mb-20">تغيير الرقم السري</h4>
      <label for="oldPassword">كلمة المرور القديمة</label>
      <input type="password" id="oldPassword" name="oldPassword" ><br />
      <label for="newPassword">كلمة المرور الجديدة</label>
      <input type="password" id="newPassword" name="newPassword" ><br /><br>
      <button type="submit" name="updatePassword">تغيير</button>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./assets/js/script.js"></script>
</body>
</html>
