<?php include "./config/connexion.php"?>

<!DOCTYPE html>
<html lang="ar" dir="rtl" >
    <head>
        <meta charset="utf-8">
        <title>معلوماتي الشخصية</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Resume Website Template Free Download" name="keywords">
        <meta content="Resume Website Template Free Download" name="description">

        <!-- Favicon -->
        <link href="./assets/img/favicon.png" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:300;400;600;700;800&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="./assets/lib/slick/slick.css" rel="stylesheet">
        <link href="./assets/lib/slick/slick-theme.css" rel="stylesheet">
        <link href="./assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="./assets/css/portfolio.css" rel="stylesheet">
    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="51">
        <div class="wrapper">
            <div class="sidebar">
                <div class="sidebar-header">
                    <img src="./assets/img/1.png"  alt="Image">
                </div>
                <div class="sidebar-content">
                    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a href="#" class="navbar-brand"></a>
                       
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <ul class="nav navbar-nav">
                               
                                <li class="nav-item">
                                    <a class="nav-link" href="#experience">مستوى تقدمي<i class="fa fa-star"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#about">معلوماتي<i class="fa fa-address-card"></i></a>
                                </li>
                              
                               
                            </ul>
                        </div>
                    </nav>
                </div>
        
            </div>
            <div class="content">
                <!-- Header Start -->
                <div class="header" id="header">
                    <div class="content-inner">
                        <p>مرحبا</p>
                      <?php
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    $userId = $_SESSION['id'];
    $sql = "SELECT * FROM étudiant WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $niveau = $row['annee'];
        echo "<h1>$nom &nbsp;$prenom</h1>";
    }
}
?>
                        <h2>تابع مستوى تقدمك</h2>
                    </div>
                </div>
                <!-- Header End -->
                
                <!-- Large Button Start -->
                <div class="large-btn">
                    <div class="content-inner">
                       
                    </div>
                </div>
                <!-- Large Button End -->
                
                <!-- About Start -->
                <div class="about" id="about">
                    <div class="content-inner">
                        <div class="content-header">
                            <h2> مستوى التقدم</h2>
                        </div>
                        <div class="row align-items-center">
                           
                          
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="skills">
                                    <div class="skill-name">
                                        &nbsp;&nbsp; <p>98%</p><p>الدرس</p>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="skill-name">
                                        &nbsp;&nbsp; <p>98%</p><p>الوحدة الجزئية</p>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="skill-name">
                                        &nbsp;&nbsp; <p>90%</p><p>الوحدة الاولى</p>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <!-- About End -->
 
                
               
               
                
                <!-- Contact Start -->
                <div class="contact" id="contact">
                    <div class="content-inner">
                        <div class="content-header">
                            <h2>معلوماتي</h2>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="contact-info">
                                    <p><i class="fa fa-user"></i><?php echo"$nom &nbsp; $prenom";?></p>
                                    <p><i class="fa fa-tag"></i> <?php echo"$niveau";?> </p>
                                    <p><i class="fa fa-envelope"></i><a href="mailto:info@example.com"><?php echo" $email";?></a></p>
                                  
                                   
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <!-- Contact End -->
                
                <!-- Footer Start -->
                <div class="footer">
                    <div class="content-inner">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                            <p>   جميع الحقوق محفوظة <script>document.write(new Date().getFullYear());</script> &copy;  | تمت برمجة هذا الموقع من طرف <a href="https://colorlib.com" target="_blank"></a> <i class="ti-heart" aria-hidden="true"></i></p>
                              
                            </div>
                          
                        </div>
                    </div>
                </div>
                <!-- Footer Start -->
            </div>
        </div>
        
        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="./assets/lib/easing/easing.min.js"></script>
        <script src="./assets/lib/slick/slick.min.js"></script>
        <script src="./assets/lib/typed/typed.min.js"></script>
        <script src="./assets/lib/waypoints/waypoints.min.js"></script>
        <script src="./assets/lib/isotope/isotope.pkgd.min.js"></script>
        <script src="./assets/lib/lightbox/js/lightbox.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="./assets/js/portfolio.js"></script>
    </body>
</html>
