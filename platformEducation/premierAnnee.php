<?php include "./includes/header.php";
include "./config/connexion.php";
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
                            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">الرئيسية <i class="fa fa-chevron-left"></i></a></span> <span> الاولى ثانوي<i class="fa fa-chevron-left"></i></span></p>
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
    <h6 class="widget_title text-center"> قائمة الوحدات التعليمية</h6>
    <ul class="list cat-lists" id="chapitre">
        <?php
        // Check if a filière is selected
        if (isset($_GET['filiere'])) {
            $selectedFiliere = $_GET['filiere'];

            // Prepare the statement
            $fetchChapitreQuery = "SELECT chapitre.chapter_name 
            FROM chapitre 
            JOIN Filière ON Filière.field_id = chapitre.filiere_id 
            WHERE Filière.field_name = ?";
            $stmt = $conn->prepare($fetchChapitreQuery);

            if ($stmt) {
                // Bind the parameter
                $stmt->bind_param("s", $selectedFiliere);

                // Execute the statement
                $stmt->execute();

                // Get the result
                $fetchChapitreResult = $stmt->get_result();

                // Display the chapitres
                if ($fetchChapitreResult->num_rows > 0) {
                    while ($chapitreRow = $fetchChapitreResult->fetch_assoc()) {
                        echo "<li class='has-dropdown'>
                                <a class='d-flex' id='chapitreList'>
                                    <p class='titre1'>" . $chapitreRow['chapter_name'] . " <i class='fas fa-chevron-down'></i></p>
                                </a>
                                <ul class='list cat-list' id='miniChapitre'>
                                    <li class='has-dropdown'>
                                        <a class='d-flex' id='listes'>
                                            <p class='titre2'>الفصل الأول <i class='fas fa-chevron-down'></i></p>
                                        </a>
                                        <ul class='list cat-list' id='bccours'>
                                            <li class='has-dropdown'>
                                                <a class='d-flex' id='cours'>
                                                    <p class='titre3'>الدرس 1 <i class='fas fa-chevron-down'></i></p>
                                                </a>
                                                <ul class='list cat-list' id='coursList'>
                                                    <li>
                                                        <p class='titre4' id='cc'><a id='cours' class='d-flex'>فيديو قصير</a></p>
                                                    </li>
                                                    <li class='has-dropdown'>
                                                        <a class='d-flex' id='questions'>
                                                            <p class='titre4'>تقويم <i class='fas fa-chevron-down'></i></p>
                                                        </a>
                                                        <ul class='list cat-list' id='questionsList'>
                                                            <li>
                                                                <p class='titre5'><a id='cours' class='d-flex'>فيديو 1</a></p>
                                                            </li>
                                                            <!-- Add more subcategories if needed -->
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>";
                    }
                } else {
                    echo "No chapitres found.";
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error in preparing the statement: " . $conn->error;
            }
        } else {
            echo "No filière selected.";
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
                                <div class="quotes text-start">
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
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    <div class="detials">
                                        <button class="button rounded-0 primary-bg text-white w-100 btn_1"
                                            type="submit">السؤال القادم</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--vidio div-->

                        <div class="col-lg-8 vidio-list " style="display: none;">
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
        const chapitre = document.getElementById('chapitre');
        const chapitreList = document.getElementById('chapitreList');
        const listes = document.getElementById('listes');
        const miniChapitre = document.getElementById('miniChapitre');
        const bccours = document.getElementById('bccours');
        const cours = document.getElementById('cours');
        const coursList = document.getElementById('coursList');
        const questions = document.getElementById('questions');
        const questionsList = document.getElementById('questionsList');


        // Add click event listener to the chapitre dropdown
        chapitreList.addEventListener('click', toggleMiniChapitre);

        // Function to toggle the display of the miniChapitre list
        function toggleMiniChapitre(e) {
            e.stopPropagation(); // Prevent the event from propagating to the chapitre dropdown
            miniChapitre.classList.toggle('show');
            bccours.classList.remove('show');
            chapitre.classList.remove('show');
        }

        // Add click event listener to the listes dropdown
        listes.addEventListener('click', toggleBcCours);

        // Function to toggle the display of the bccours list
        function toggleBcCours(e) {
            e.stopPropagation(); // Prevent the event from propagating to the listes dropdown
            bccours.classList.toggle('show');
           
        }

        // Add click event listener to the cours dropdown
        cours.addEventListener('click', toggleCoursList);

        // Function to toggle the display of the cours list
        function toggleCoursList(e) {
            e.stopPropagation(); // Prevent the event from propagating to the cours dropdown
            coursList.classList.toggle('show');
            chapitre.classList.remove('show');
        }

        // Add click event listener to the questions dropdown
        questions.addEventListener('click', toggleQuestionsList);

        // Function to toggle the display of the questions list
        function toggleQuestionsList(e) {
            e.stopPropagation(); // Prevent the event from propagating to the questions dropdown
            questionsList.classList.toggle('show');
           
        }

        // Add click event listener to the document to hide the dropdown lists
        document.addEventListener('click', hideDropdownLists);

        // Function to hide the dropdown lists
        function hideDropdownLists() {
            miniChapitre.classList.remove('show');
            bccours.classList.remove('show');
            coursList.classList.remove('show');
            questionsList.classList.remove('show');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var widgetTitle = document.querySelector('.widget_title');

            widgetTitle.addEventListener('click', function () {
                this.classList.toggle('open');
            });
        });

        // Get the elements
const videoElement = document.getElementById('cc');
const singlePostElement = document.querySelector('.posts-list');
const vidio = document.querySelector('.vidio-list');

// Add click event listener to the video element
videoElement.addEventListener('click', function() {
  // Hide the single post element
  singlePostElement.style.display = 'none';
 // show the vidio post element
  vidio.style.display = 'block';
});
    </script>
    <?php include "./includes/footer.php"?>
