<?php
// Assuming you have the user's role stored in the $userRole variable
$userRole = "ens"; // Replace with the actual user's role
include "./config/connexion.php";

?>
 <!-- sidbar-->
  <div class="sidebar bg-white p-20 p-relative">
        <h3 class="p-relative txt-c mt-0">
          <img src="./assets/imgs/logo.png" alt="Elzero" style="max-width: 100%; height: auto;">
        </h3>
        <ul>
    
          <li>
            <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="filiere.php">
              <i class="fas fa-user-graduate fa-fw"></i>
              &nbsp;
              &nbsp;
              <span> الشعب</span>
            </a>
          </li>
          <li>
            <a class="d-flex align-center fs-14 c-black rad-6 p-10 toggle-year" href="#">
              <i class="fas fa-book-reader fa-fw"></i>
              &nbsp;
              &nbsp;
              <span >ادارة المنهج </span>
            </a>
            <ul class="year-list">
              <li class="year-item"><a href="premiere.php" style="color: black;" >     <i class="fas fa-1"></i>               السنة الأولى  </a> </li>
              <li class="year-item"><a href="deuxieme.php" style="color: black;" >     <i class="fas fa-2"></i>               السنة الثانية </a></li>
              <li class="year-item"><a href="troisieme.php" style="color: black;">     <i class="fas fa-3"></i>         السنة الثالثة </a></li>
              <li class="year-item"><a href="programme.php" style="color: black;">     <i class="fas fa-3"></i>                                     اضافة منهج جديد</a></li>
            </ul>
          </li>
          <li>
            <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="student.php">
              <i class="fas fa-user-graduate fa-fw"></i>
              &nbsp;
              &nbsp;
              <span>قائمة التلاميذ</span>
            </a>
          </li>
       
          <li>
            <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="quizs.php">
              <i class="fa-regular fa-file fa-fw"></i>
              &nbsp;
              &nbsp;
              <span>تقويم </span>
            </a>
          </li>
         
          <li>
            <a class="d-flex align-center fs-14 c-black rad-6 p-10 toggle-quiz" href="cours.php">
              <i class="fa-regular fa-chart-bar fa-fw"></i>
              &nbsp;
              &nbsp;
              <span> اضافة درس </span>
            </a>
            <ul class="quiz-list">
              <li class="quiz-item"><a href="quizs.php" style="color: black;">     <i class="fas fa-1"></i>               السنة الأولى  </a> </li>
              <li class="quiz-item"><a href="quizs.php" style="color: black;">     <i class="fas fa-2"></i>               السنة الثانية </a></li>
              <li class="quiz-item"><a href="quizs.php" style="color: black;">     <i class="fas fa-3"></i>                                        السنة الثالثة </a></li>
            </ul>
            </li>
           <!-- Display the list items conditionally based on the user's role -->
<?php if (!isset($_SESSION['id']) || $_SESSION['id'] !== 'ens') { ?>
    <li>
        <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="setting.php">
            <i class="fas fa-chalkboard-teacher fa-fw"></i>
            &nbsp;
            &nbsp;
            <span>حسابي</span>
        </a>
    </li>
    <li>
        <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="settingEns.php">
            <i class="fas fa-chalkboard-teacher fa-fw"></i>
            &nbsp;
            &nbsp;
            <span>حساب الاساتذة</span>
        </a>
    </li>
<?php } ?>
            </ul>
  
      </div>  

      <!-- FIN SIDEBAR--> 
