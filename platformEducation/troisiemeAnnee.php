<?php include "./config/connexion.php";
include "./includes/header.php";

?>
    <!-- breadcrumb start-->
    <!-- ================ contact section start ================= -->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Blog Single</h2>
                            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">الرئيسية <i class="fa fa-chevron-left"></i></a></span> <span> الثانية ثانوي<i class="fa fa-chevron-left"></i></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog_area single-post-area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='البحث'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'البحث'">
                                        <div class="input-group-append">
                                            <button class="btn" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1"
                                    type="submit">بحث</button>
                            </form>
                        </aside>



                        <aside class="single_sidebar_widget">
    <h6 class="widget_title text-center">قائمة الوحدات التعليمية</h6>
    <ul class="list cat-lists" id="chapitre">
        <?php
        // Check if a filière is selected
        if (isset($_GET['filiere'])) {
            $selectedFiliere = $_GET['filiere'];

            // Fetch chapitres and sub-chapitres for the selected filière
            $fetchChapitreQuery = "SELECT chapitre.chapter_id, chapitre.chapter_name, sous_chapitre.subchapter_id, sous_chapitre.subchapter_name
              FROM chapitre 
                JOIN Filière ON Filière.field_id = chapitre.filiere_id 
                JOIN année ON Filière.year_id = année.year_id
                LEFT JOIN sous_chapitre ON sous_chapitre.chapter_id = chapitre.chapter_id
                WHERE Filière.field_name = '$selectedFiliere' AND année.year_id = 3";
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
                    $fetchChapterNameQuery = "SELECT chapter_name FROM chapitre WHERE chapter_id = $chapterId";
                    $fetchChapterNameResult = $conn->query($fetchChapterNameQuery);
                    if ($fetchChapterNameResult->num_rows > 0) {
                        $chapterName = $fetchChapterNameResult->fetch_assoc()['chapter_name'];
                        echo "<li class='has-dropdown'>
                                <a class='d-flex chapitreList' id='chapitreList_$chapterId'>
                                    <p class='titre1'>" . $chapterName . " <i class='fas fa-chevron-down'></i></p>
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
                            $fetchCoursQuery = "SELECT course_id, course_name
                                                FROM cours
                                                WHERE subchapter_id = $subChapterId";
                            $fetchCoursResult = $conn->query($fetchCoursQuery);
                            if ($fetchCoursResult->num_rows > 0) {
                                while ($coursRow = $fetchCoursResult->fetch_assoc()) {
                                    $courseId = $coursRow['course_id'];
                                    $courseName = $coursRow['course_name'];

                                    // Display the course name
                                    echo "<li class='has-dropdown'>
                                    <a class='d-flex courseItem' id='cours_$courseId'>
                                        <p class='titre3'>" . $courseName . " <i class='fas fa-chevron-down'></i></p>
                                    </a>
                                    <ul class='list cat-list quizzes' id='quizzes_$courseId'>";
                                    // Fetch and display the quizzes for the course
                                    $fetchQuizQuery = "SELECT quiz_id, quiz_name FROM quiz WHERE course_id = $courseId";
                                    $fetchQuizResult = $conn->query($fetchQuizQuery);

                                    if ($fetchQuizResult->num_rows > 0) {
                                        while ($quizRow = $fetchQuizResult->fetch_assoc()) {
                                            $quizId = $quizRow['quiz_id'];
                                            $quizName = $quizRow['quiz_name'];

                                            echo "<li>
                                             <a class='d-flex' id='quiz_$quizId'>
                                                 <p class='titre4'>" . $quizName . "</p>
                                             </a>
                                         </li>";
                                        }
                                    } else {
                                        echo " <p class='titre4'>لم يتم العثور على اختبارات.</p>";

                                    }

                                    echo "<li>
                                            <p class='titre4' id='cc'>
                                                <a id='cours' class='d-flex'> فيديو قصير</a>
                                            </p>
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

                </div>
            </div>
            <div class="col-lg-8 posts-list">
                <div class="single-post ">
                    <div class="blog_details">
                        <h2>Second divided from form fish beast made every of seas
                            all gathered us saying he our
                        </h2>

                        <p class="excert"></p>
                        <div class="quote-wrapper">
                            <p class="text-center">السؤال </p>
                            <div class="quotes text-right">
                                هل تحب زهرة
                            </div>
                            <div class="form-group mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="responseCheckbox">
                                    <label class="form-check-label" for="responseCheckbox">
                                        أجب بنعم
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                        <div class="detials">
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1" type="submit">السؤال القادم</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--vidio div-->

            <div class="col-lg-8 vidio-list" style="display: none;">
                <div class="single-post ">
                    <div class="blog_details">
                        <h2>vidio</h2>
                        <p class="excert"></p>
                        <div class="quote-wrapper ">
                            <p class="text-center">السؤال </p>
                            <div class="quotes text-start">
                                هل تحب زهرة
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chapitreList = document.querySelectorAll('.chapitreList');
        const miniChapitreList = document.querySelectorAll('.miniChapitre');
        const listes = document.querySelectorAll('.listes');
        const bccoursList = document.querySelectorAll('.bccours');
        const quizzes = document.querySelectorAll('.quizzes');

 

        chapitreList.forEach(function (chapitre) {
            chapitre.addEventListener('click', function () {
                const chapterId = this.id.split('_')[1];

                miniChapitreList.forEach(function (miniChapitre) {
                    if (miniChapitre.id === 'miniChapitre_' + chapterId) {
                        miniChapitre.classList.toggle('show');
                    } else {
                        miniChapitre.classList.remove('show');
                    }
                });
            });
        });

        listes.forEach(function (liste) {
            liste.addEventListener('click', function (e) {
                e.stopPropagation();
                const subChapterId = this.id.split('_')[1];
                const bccours = document.getElementById('bccours_' + subChapterId);
                bccours.classList.toggle('show');
            });
        });

        var widgetTitle = document.querySelector('.widget_title');

        widgetTitle.addEventListener('click', function () {
            this.classList.toggle('open');
        });

        // Get the elements
        const videoElement = document.getElementById('cc');
        const singlePostElement = document.querySelector('.posts-list');
        const vidio = document.querySelector('.vidio-list');

        // Add click event listener to the video element
        videoElement.addEventListener('click', function () {
            // Hide the single post element
            singlePostElement.style.display = 'none';
            // Show the vidio post element
            vidio.style.display = 'block';
        });
    });
        // Get the elements
        const videoElement = document.getElementById('cc');
    const singlePostElement = document.querySelector('.posts-list');
    const vidio = document.querySelector('.vidio-list');

    // Add click event listener to the video element
    videoElement.addEventListener('click', function () {
      // Hide the single post element
      singlePostElement.style.display = 'none';
      // Show the vidio post element
      vidio.style.display = 'block';
    });

    // Add click event listener to course items
    const courseItems = document.querySelectorAll('.courseItem');
    courseItems.forEach(function (courseItem) {
      courseItem.addEventListener('click', function (e) {
        e.stopPropagation();
        const courseId = this.id.split('_')[1];
        const quizzes = document.getElementById('quizzes_' + courseId);
        quizzes.classList.toggle('show');
      });
    });
  
</script>
</script>

<?php include "./includes/footer.php"?>