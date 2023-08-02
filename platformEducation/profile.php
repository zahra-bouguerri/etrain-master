

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
include "./config/connexion.php";

// Assuming the user is logged in and you have $_SESSION['loggedIn'] and $_SESSION['id'] set.

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    $userId = $_SESSION['id'];

    // Fetch student's information from the "étudiant" table
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

        // Update grades table with "course_id," "subchapter_id," and "chapter_id" based on "quiz_id"
        $update_grades_sql = "
        UPDATE grades
        JOIN quiz ON grades.quiz_id = quiz.quiz_id
        JOIN cours ON quiz.course_id = cours.course_id
        SET grades.course_id = quiz.course_id
        WHERE grades.student_id = ?";
    $stmt_update_grades = $conn->prepare($update_grades_sql);
    $stmt_update_grades->bind_param("i", $userId);
    $stmt_update_grades->execute();
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
            <h2>  مستوى التقدم في الدروس</h2>
        </div>
        <div class="row align-items-center">

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="skills">
                    <?php
                    // Fetch the average scores for each course and student
                    $sql_avg_scores = "SELECT course_id, AVG(score) AS avg_score FROM grades WHERE student_id = ? GROUP BY course_id";
                    $stmt_avg_scores = $conn->prepare($sql_avg_scores);
                    $stmt_avg_scores->bind_param("i", $userId);
                    $stmt_avg_scores->execute();
                    $result_avg_scores = $stmt_avg_scores->get_result();

                    // Process the average scores and display them
                    if ($result_avg_scores->num_rows > 0) {
                        while ($row_avg_score = $result_avg_scores->fetch_assoc()) {
                            $course_id = $row_avg_score['course_id'];
                            $avg_score = $row_avg_score['avg_score'];

                            // Get the course name based on the course_id (you need to have a "course" table with course_id and course_name)
                            $sql_course = "SELECT course_name FROM cours WHERE course_id = ?";
                            $stmt_course = $conn->prepare($sql_course);
                            $stmt_course->bind_param("i", $course_id);
                            $stmt_course->execute();
                            $result_course = $stmt_course->get_result();
                            $row_course = $result_course->fetch_assoc();
                            $course_name = $row_course['course_name'];

                            // Determine the class for the progress bar based on the score range
                            $progress_bar_class = 'progress-bar bg-success'; // Default: Green
                            if ($avg_score < 50) {
                                $progress_bar_class = 'progress-bar bg-danger'; // Red
                            } elseif ($avg_score >= 50 && $avg_score < 80) {
                                $progress_bar_class = 'progress-bar bg-warning'; // Orange
                            }

                            echo "<div class='skill-name'>";
                            echo "&nbsp;&nbsp;<p>" . round($avg_score) . "%</p><p>$course_name</p>";
                            echo "</div>";
                            echo "<div class='progress'>";
                            echo "<div class='$progress_bar_class' role='progressbar' aria-valuenow='$avg_score' aria-valuemin='0' aria-valuemax='100' style='width: $avg_score%;'></div>";
                            echo "</div>";
                        }
                    } else {
                        echo "No data available.";
                    }
                  
                   
                    ?>
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
