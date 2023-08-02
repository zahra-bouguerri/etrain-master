<?php

include "./config/connexion.php";

if (isset($_POST['login'])) {
    // Login logic
    $email = $_POST['emaillogin'];
    $motPass = $_POST['motPasslogin'];

    $sql = "SELECT * FROM étudiant WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($motPass, $row['motPass'])) {
            $success = 'تم تسجيل الدخول بنجاح!';

            // Check if user is already logged in
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
                // Log out the existing session
                session_unset();
                session_destroy();
            }

            $_SESSION['id'] = $row['student_id'];
            $_SESSION['loggedIn'] = true;

            // Set cookie for persistent login if "Remember Me" is checked
            if (isset($_POST['remember_me']) && $_POST['remember_me'] == 1) {
                $cookie_name = 'remember_me_cookie';
                $cookie_value = $_SESSION['id'];
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Cookie expires in 30 days
            }

            $loggedIn = true;

            echo "<script>alert('تم الدخول بنجاح ');</script>";
            echo "<script>window.location.href='index.php';</script>";
            exit();
        } else {
            $password_error = 'كلمة المرور خاطئة ';
        }
    } else {
        $email_error = "البريد الالكتروني الذي ادخلته غير موجود  ";
    }
}
?>
   
<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="./assets/css/login.css" />
    <!-- Favicon -->
    <link href="./assets/img/favicon.png" rel="icon">
    <title>تسجيل الدخول والتسجيل</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form  method="POST" class="sign-in-form">
            <h2 class="title">تسجيل الدخول</h2>
                <?php if (isset($email_error)) { ?>
                <div class="error" id="error"><?php echo $email_error; ?></div>
            <?php } elseif (isset($password_error)) { ?>
                <div class="error" id="error"><?php echo $password_error; ?></div>
            <?php }?>
         
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="البريد الالكتروني" name="emaillogin" required />
            
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="كلمة المرور" name="motPasslogin" required />
            
            </div>
            <input type="submit" value="دخول" name="login" class="btn solid" />
            <input type="checkbox" name="remember_me" value="1"> تذكرني
         
          </form>
          <form method="POST" action="creatcompte.php" class="sign-up-form">
            <h2 class="title"> انشاء حساب</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="الاسم" name="nom" required />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="اللقب" name="prenom" required />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <select name="niveau" class="niveau" required>
                <option value=""> --اختر--</option>
                <option value="الأولى ثانوي">الأولى ثانوي</option>
                <option value="الثانية ثانوي">الثانية ثانوي</option>
                <option value="الثالثة ثانوي">الثالثة ثانوي</option>
                </select>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="البريد الالكتروني" name="email" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="كلمة المرور" name="motPass" required />
            </div>
            <input type="submit" class="btn" name="signin" value=" انشاء حساب" />
         
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel right-panel">
          <div class="content">
            <h3>لديك حساب؟</h3>
            <p>
              إذا كان لديك حساب بالفعل، انقر على هذا الزر لتسجيل الدخول.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              دخول
            </button>
          </div>
          <img src="./assets/img/log.svg" class="image" alt="" />
        </div>
        <div class="panel left-panel">
          <div class="content">
            <h3>لا تملك حساب؟ </h3>
            <p>
              إذا كنت لا تملك حساب ، انقر على هذا الزر لانشاء حساب.
            </p>
            <button class="btn transparent" id="sign-in-btn"> انشاء حساب </button>
          </div>
          <img src="./assets/img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="./assets/js/app.js"></script>
    
  </body>
</html>
