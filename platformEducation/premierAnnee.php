<?php include "./config/connexion.php";
include "./includes/header.php";?>

    <!-- breadcrumb start-->
    <!-- ================ contact section start ================= -->
   

    <section class="blog_area single-post-area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                    <form id="quizForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="selected_quiz_id" id="selected_quiz_id" value="<?php echo $quiz_id; ?>">
                        <aside class="single_sidebar_widget">
    <h6 class="widget_title text-center">قائمة الوحدات التعليمية</h6>
    <ul class="list cat-lists" id="chapitre">
        <?php
          // Function to check if the current URL parameter matches the given value
          function isCurrentParameter($paramName, $paramValue)
          {
              return isset($_GET[$paramName]) && $_GET[$paramName] == $paramValue;
          }
        // Check if a filière is selected
        if (isset($_GET['filiere'])) {
            $selectedFiliere = $_GET['filiere'];

            // Fetch chapitres and sub-chapitres for the selected filière
            $fetchChapitreQuery = "SELECT chapitre.chapter_id, chapitre.chapter_name, sous_chapitre.subchapter_id, sous_chapitre.subchapter_name
                FROM chapitre 
                JOIN Filière ON Filière.field_id = chapitre.filiere_id 
                JOIN année ON Filière.year_id = année.year_id
                LEFT JOIN sous_chapitre ON sous_chapitre.chapter_id = chapitre.chapter_id
                WHERE Filière.field_name = '$selectedFiliere' AND année.year_id = 1";
            $fetchChapitreResult = $conn->query($fetchChapitreQuery);

            // Create an associative array to group sub-chapters by their corresponding chapters
            $subChapitresByChapter = array();
            while ($chapitreRow = $fetchChapitreResult->fetch_assoc()) {
                $chapterId = $chapitreRow['chapter_id'];
                $chapterName = $chapitreRow['chapter_name'];
                $subChapterId = $chapitreRow['subchapter_id'];
                $subChapterName = $chapitreRow['subchapter_name'];

                // Group sub-chapters under their respective chapters
                $subChapitresByChapter[$chapterId][] = array('subChapterId' => $subChapterId, 'subChapterName' => $subChapterName);
            }

            // Display the chapitres and sub-chapitres
            if (!empty($subChapitresByChapter)) {
                foreach ($subChapitresByChapter as $chapterId => $subChapitres) {
                    // Fetch the chapter name
                    $fetchChapterNameQuery = "SELECT chapter_name,etat FROM chapitre WHERE chapter_id = $chapterId";
                    $fetchChapterNameResult = $conn->query($fetchChapterNameQuery);
                    if ($fetchChapterNameResult && $fetchChapterNameResult->num_rows > 0) {
                        $row = $fetchChapterNameResult->fetch_assoc();
                        $chapterName = $row['chapter_name'];
                        $etat = $row['etat'];
                    
                        echo "<li class='has-dropdown'>
                                <a class='d-flex chapitreList' id='chapitreList_$chapterId'>
                                    <p class='titre1'>" . $chapterName . " <i class='fas fa-chevron-down'></i></p><br>
                                    <span class='etat-chapitre text-left'><b>".$etat."</b></span>
                                    </a>
                                <ul class='list cat-list miniChapitre' id='miniChapitre_$chapterId'>";

                        foreach ($subChapitres as $subChapitre) {
                            $subChapterId = $subChapitre['subChapterId'];
                            $subChapterName = $subChapitre['subChapterName'];

                            echo "<li class='has-dropdown'>
                                    <a class='d-flex listes' id='listes_$subChapterId'>
                                        <p class='titre2'>" . $subChapterName . " <i class='fas fa-chevron-down'></i></p>
                                    </a>
                                    <ul class='list cat-list bccours' id='bccours_$subChapterId'>";

                           // Fetch and display the courses for the sub-chapter
                                    $fetchCoursQuery = "SELECT *
                                    FROM cours
                                    WHERE subchapter_id = $subChapterId";
                                    $fetchCoursResult = $conn->query($fetchCoursQuery);
                                    if ($fetchCoursResult->num_rows > 0) {
                                    while ($coursRow = $fetchCoursResult->fetch_assoc()) {
                                    $courseId = $coursRow['course_id'];
                                    $courseName = $coursRow['course_name'];
                                    $target_video = $coursRow['video_name']; // Make sure the video_name field is correct
                                    $target_pdf = $coursRow['pdf_name'];
                                    
                                    // Fetch the video URL and set it to $vidio
                                      $vidio =   $target_video;
                                      $pdf =  $target_pdf;
                                      // Display the course name
                                    echo "<li class='has-dropdown'>
                                    <a class='d-flex courseItem' id='cours_$courseId'>
                                        <p class='titre3'>" . $courseName . " <i class='fas fa-chevron-down'></i></p>
                                        <span class='etat-chapitre text-left'><b>".$etat."</b></span>
                                        </a>
                                    <ul class='list cat-list quizzes' id='quizzes_$courseId'>";
                                                              // Fetch the first quiz for each course
        $fetchQuizQuery = "SELECT quiz_id, quiz_name FROM quiz WHERE course_id = $courseId LIMIT 1";
        $fetchQuizResult = $conn->query($fetchQuizQuery);

        $loggedIn = isset($_SESSION['loggedIn']);
        $userId = $_SESSION['id'] ?? null;
        if ($fetchQuizResult->num_rows > 0) {
            $quizRow = $fetchQuizResult->fetch_assoc();
            $quizId = $quizRow['quiz_id'];
            $quizName = $quizRow['quiz_name'];

            $link = "quiz.php?quiz=" . $quizId . "&user=" . $userId;
        echo "<li>
        <a class='d-flex quizItem' id='quiz_$quizId' href='$link'>
            <p class='titre4'> " . $quizName . "</p>
        </a>
      </li>";
        } else {
            echo " <p class='titre4'> لم يتم العثور على اختبار.</p>";
        }

                                    echo "<li>
                                            <p class='titre4' id='cc'>
                                            <a id='cours' class='d-flex' href='javascript:void(0);' onclick='showVideo(\"" . $vidio . "\")'>فيديو</a>
                                            </p>
                                        </li>
                                        <li>
                                            <p class='titre4' id='cc'>
                                            <a id='cours' class='d-flex' href='javascript:void(0);' onclick='showPDF(\"" . $pdf . "\")'>ملخص الدرس</a>                                            </p>
                                        </li>
                                    </ul></li>";
                                }
                            } else {
                                echo "<li>لم يتم العثور على دروس.</li>";
                            }

                            echo "</ul>
                                </li>";
                        }

                        echo "</ul>
                            </li>";
                    }
                }
            } else {
                echo "لم يتم العثور على فصول.";
            }
        } else {
            echo "لم يتم اختيار تخصص.";
        }
        ?>
    </ul>
</aside>
<?php 

?>
                </div>
            </div>
            <div class="col-lg-8 posts-list">
                    <div class="single-post ">
                        <div class="blog_details">
                          
  
                            <p class="excert"></p>
                            <div class="quote-wrapper">
                            <h3 class="text-center">معلومات مهمة </h3>
                            <div class="quotes text-right">
                            مرحبًا بك في موقعنا!<br>

نحن هنا لنقدم لك فرصة ممتعة للاختبار وتحسين مهاراتك التعليمية. يُرجى اختيار الفصل الدراسي الذي تود الاطلاع عليه، ثم حدد الفصل الفرعي، وبعد ذلك اختر المقرر الذي يحتوي على الاختبارات.

عندما تختار الاختبار، سيتم تحويلك إلى صفحة أخرى للقيام بالاختبار. <b>يجب أن تكون قد قمت بتسجيل الدخول باستخدام حسابك الشخصي لكي يتم حفظ درجاتك في ملفك الشخصي.
</b>ولكن 
إذا كانت نتيجتك في الاختبار أقل من 60٪، فسيتم تحويلك للمشاركة في اختبار آخر لنفس المقرر الدراسي، حتى تتمكن من تحسين درجتك.

نحن نأمل أن يكون هذا الموقع مفيدًا لك وأن تستمتع بالتعلم والتحسين باستمرار. إذا كان لديك أي استفسارات أو أسئلة، فلا تتردد في التواصل معنا.

<br> شكرًا لزيارتكم ونتمنى لكم وقتًا ممتعًا هنا! 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
            <!--vidio div-->

            <div class="col-lg-8 vidio-list" style="display: none;">
    <div class="single-post">
    <div class="blog_details text-right">
            <h2><?php echo $courseName;?></h2>
            <p class="excert"></p>
            <div class="quote-wrapper">
              
                <div class="video-wrapper">
            <!-- Video player container -->
<!-- Video player container -->
<!-- Video player container -->
<video id="videoPlayer" controls width="640" style="display: none;">
    <source src="<?php echo $vidio; ?>" type="video/mp4">
</video>
        </div>
            </div>
        </div>
        
    </div>
</div>

        </div>
    </div>
</section>

<script>
    
    function showVideo(videoUrl) {
        var videoPlayer = document.getElementById("videoPlayer");
        var videoWrapper = document.querySelector(".vidio-list");

        // Show the video wrapper and video player
        videoWrapper.style.display = "block";
        videoPlayer.style.display = "block";

        // Set the source of the video player
        videoPlayer.src = videoUrl;
    }

    function showPDF(pdfPath) {
  // Create a hidden anchor element to initiate the download
  var downloadLink = document.createElement('a');
  downloadLink.href = pdfPath;
 

  // Append the link to the document (this step is essential for some browsers)
  document.body.appendChild(downloadLink);

  // Trigger the click event on the anchor element
  downloadLink.click();

  // Remove the anchor element from the document (optional but recommended)
  document.body.removeChild(downloadLink);
}
</script>

<script src="./assets/js/script.js"></script>


<?php include "./includes/footer.php"?>