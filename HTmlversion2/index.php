<?php
include './config/connexion.php';

// Check if the user has submitted the login form
// by checking if the submit button was clicked
if (isset($_POST['submit'])) {
    // Get the email and password values from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['roles'];

    // Build SQL query to select the user with the specified email and role
    $sql = "SELECT * FROM admin WHERE email='$email' and roles='$role'";

    // Run the query and save the result in a variable
    $result = $conn->query($sql);

    // Check if the query returned exactly one row
    if ($result->num_rows == 1) {
        // If so, fetch the row as an associative array
        // and save it in a variable
        $row = mysqli_fetch_assoc($result);

        if($password===$row["motPass"]){
            $_SESSION['id'] = $row['id'];
            header("Location:./programme.php");
            exit(); 
       
        } else {
            $password_error = "كلمة المرور غير صحيحة."; 
        }
}else {
    $email_error = "البريد الإلكتروني أو الدور غير صحيح.";

}
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
	<title>دخول لوحة التحكم </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<link rel="stylesheet" href="./assets/css/Admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Site Icons -->
    <link rel="shortcut icon" href="assets/imgs/favicon.png" type="image/x-icon" />
    <link href="../platformEducation/assets/img/favicon.png" rel="icon">

   
</head>
<body>
 <div class="wrapper">
 	<div class="heading">
 		<h1>تسجيل الدخول</h1>
 	</div>
	<div class="form">
 		<form method="post">
 			<span>
 				<i class="fa fa-envelope"></i>
 				<input type="email" placeholder="entre votre email" name="email" required>
                 <?php if (isset($email_error)) { ?>
                <div class="error" id="error"><?php echo $email_error; ?></div>
            <?php } ?>
 			</span><br>
 			<span>
                <i class="fa-solid fa-lock"></i>
 				<input type="password" placeholder="entre votre mot de passe" class="password" id="password" name="password" required>
                 <ion-icon name="eye-outline" id="password-icon" class="password-icon" onclick="togglePasswordVisibility('password', 'password-icon');"></ion-icon>
                <?php if (isset($password_error)) { ?>
                <div class="error" id="error"><?php echo $password_error; ?></div>
            <?php } ?>
 			</span><br>
            
             <div class="role-selection">
                            <p class="role-title">دورك:</p>
                            <select name="roles" class="roles" required>
                                <option value="">-اختر-</option>
                                <option value="admin">مسؤول</option>
                                <option value="ens">استاذ</option>
                              
                            </select>
            </div>
            <br>

            <!-- login page code -->
             <input id="submit" type="submit" name="submit" value="دخول">
            
	</form>
    <script src="assets/js/main.js"></script>

</body>
</html>