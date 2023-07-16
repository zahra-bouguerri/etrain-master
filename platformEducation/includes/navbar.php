<nav class="navbar navbar-expand-lg navbar-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                       </button>
                  <div class="logo-div">
                        <a class="logo" href="index.php"> <img src="./assets/img/logo.png" width="100px" alt="logo"> </a>
                        &nbsp; &nbsp;  <H4 class="aa">الرياضيات للثانوي</H4>
</div>
                        <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">الرئيسية</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.php">حول الموقع</a>
                                </li>
                               
                               
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        السنوات
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="index.php#1st">  الأولى ثانوي</a>
                                        <a class="dropdown-item" href="index.php#2st">الثانية ثانوي</a>
                                        <a class="dropdown-item" href="index.php#3st">الثالثة ثانوي</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.php">تواصل معنا</a>
                                </li>
                               
                                <li class="nav-item " >
                                <a class="btn_1" href="login.php" target="index.php">دخول</a>
                                  
                                </li>
                                <li class="nav-item info">
    <?php
    if (!isset($_SESSION['loggedIn'])) {
        echo '
        <div class="container">
        <div class="row">
        <div id="login-message" style="display: none;" >
                <h6 id="name">يرجى تسجيل الدخول للاستفادة من جميع المزايا وتتبع تقدمك</h6>
               <i  onclick="closeLoginMessage()" class="fas fa-times"></i>
          </div>
                </div>
            </div>
        <a href="javascript:void(0);" onclick="showLoginMessage()"><i class="fas fa-user-circle"></i></a>
        ';
    } else {
        echo '<a class="" href="profile.php" target="index.php"><i class="fas fa-user-circle"></i></a>';
    }
    ?>
</li>
                                <li class="nav-item  dark" onclick="dark();" >
                                    <i id="mode-icon" class="fas fa-moon"></i>
                                  </li>
                               
                            </ul>
                           
                        </div>
                    </nav>
                    <script>

</script>