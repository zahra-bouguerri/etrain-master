<?php include "./config/connexion.php"?>
<?php include "./includes/header.php"?>

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h2>استكشاف عالم الرياضيات المثير</h2>
                                <p>تتجدد الفصول ويكبر الإنسان. يبحث كل إنسان عن إثراء حياته بالمعرفة والتعلم.<br> هنا، ستجد المساعدة التي تحتاجها لتعزيز مهاراتك ومعرفتك في الرياضيات. تعلم الدروس وأجب عن الأسئلة للوصول إلى تقدمك. إذا أجبت بشكل صحيح، فسوف تحصل على تقييم نهائي يعكس جهودك. وفي حال عدم الإجابة بشكل صحيح، ستتاح لك الفرصة لإعادة الأسئلة وتحسين أدائك. بالإضافة إلى ذلك، ستجد مقاطع فيديو توضيحية لكل درس تساعدك على فهم الأفكار بشكل أفضل.
                                    نحن نهدف لتحسين تجربتك التعليمية وتطوير مهاراتك في الرياضيات. انضم إلينا الآن واكتشف إمكاناتك وحقق تطورك في عالم الرياضيات للشباب في المدرسة الثانوية.</p>
                            <a href="login.php" class="btn_2"> انضم الينا </a>
                            <a href="" class="btn_1">ابدا ! </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- feature_part start-->
    <section class="feature_part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">  
                        <h2>السمات المميزة لموقعنا التعليمي</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><i class="fas fa-question"></i></span>
                            <h4>الأسئلة</h4>
                            <p>أسئلة متنوعة مطابقة لمنهج الرياضيات لطلاب المدارس الثانوية</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><i class="fas fa-sitemap"></i></span>
                            <h4>الهيكلية</h4>
                            <p> أسئلة منظمة حسب الوحدة الدراسية، حسب المقرر، حسب السنة</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="single_feature">
                        <div class="single_feature_part single_feature_part_2">
                            <span class="single_service_icon style_icon"><i class="fas fa-check-circle"></i></span>
                            <h4>موثوقية</h4>
                            <p>أسئلة تم تصحيحها والتحقق منها بناءً على أحدث التوصيات</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="single_feature">
                        <div class="single_feature_part single_feature_part_2">
                            <span class="single_service_icon style_icon"><i class="fas fa-cogs"></i></span>
                            <h4>سهولة الاستخدام</h4>
                            <p>تصميم واجهة سهلة الاستخدام لتمكين المستخدمين من التفاعل بسهولة مع الموقع</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- upcoming_event part start-->

    <!-- learning part start-->
    <section class="learning_part">
        <div class="container">
            <div class="row align-items-sm-center align-items-lg-stretch">
                <div class="col-md-5 col-lg-5">
                    <div class="learning_member_text">
                        <h5>حولنا </h5>
                        <h2> مصادر رياضيات تفاعلية لطلاب المدارس الثانوية</h2>
                        <p>مرحبًا بك في منصتنا المخصصة لتوفير مصادر رياضيات تفاعلية لطلاب المدارس الثانوية. 
                            استكشف مجموعة واسعة من الأسئلة المتنوعة التي تغطي مختلف المواضيع الرياضية، والتي تهدف إلى تعزيز فهمك ومهارات حل المسائل. بالإضافة إلى ذلك، تمتع بوصول إلى مجموعة من الفيديوهات التعليمية في الرياضيات، المختارة بعناية لتعزيز تجربتك التعليمية. سواء كنت تستعد للاختبارات أو تسعى لتعزيز أساسك في الرياضيات، تقدم منصتنا مصادر تفاعلية ممتعة وملائمة لاحتياجات طلاب المدارس الثانوية.
                             اغمر نفسك في عالم الرياضيات واستكشف إمكانياتها بطريقة مسلية وسهلة التوصل إليها.</p>

                    </div>
                </div>
                <div class="col-md-7 col-lg-7">
                    <div class="learning_img">
                        <img src="./assets/img/learning_img.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- learning part end-->
    <?php 
    function getCountByNiveau($niveau) {
  global $conn;
  $sql = "SELECT COUNT(*) as count FROM étudiant WHERE annee = '$niveau'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  return $row['count'];
}
function getTotalCount() {
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM étudiant";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}
?>
    <!-- member_counter counter start -->
    <section class="member_counter">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                        <span class="counter"><?php echo getCountByNiveau("الأولى ثانوي"); ?></span>
                        <h4>الأولى ثانوي</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                    <span class="counter"><?php echo getCountByNiveau(" الثانية ثانوي"); ?></span>
                        <h4> الثانية ثانوي</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                    <span class="counter"><?php echo getCountByNiveau("الثالثة ثانوي"); ?></span>
                        <h4>الثالثة ثانوي</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                    <span class="counter"><?php echo getTotalCount(); ?></span>
                        <h4>جميع المستويات</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- member_counter counter end -->

    <!--::review_part start::-->
    <section class="special_cource padding_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <h2> السنوات التعليمية</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-6 col-lg-4" id="1st">
                    <div class="single_special_cource">
                        <img src="./assets/img/2.png" class="special_img"  width="70%" alt="">
                        <div class="special_cource_text">
                            <a href="premierAnnee.php" class="btn_4"> الاولى ثانوي</a>
                            <div class="author_info">
                                <div class="author_img">
                                    <div class="author_info_text">
                                        <p>اختر تخصصك لتجد الأسئلة المناسبة لمستواك</p><br>
                                        <H5>الشعبةالتعليمية</H5>
                                        <ul class="navbar-nav align-items-start">
                                        <?php
  // Fetch Filières for the 2nd year
  $fetchFiliereQuery2 = "SELECT * FROM Filière WHERE year_id = 1";
  $fetchFiliereResult2 = $conn->query($fetchFiliereQuery2);
  if ($fetchFiliereResult2->num_rows > 0) {
    while ($row2 = $fetchFiliereResult2->fetch_assoc()) {
      echo "<li><a href='premierAnnee.php?filiere=" . $row2['field_name'] . "'><i class='fas fa-arrow-left'></i>&nbsp;" . $row2['field_name'] . "</a></li>";
    }
  }
  ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6 col-lg-4" id="2st">
                    <div class="single_special_cource">
                        <img src="./assets/img/3.png" class="special_img"  width="70%" alt="">
                        <div class="special_cource_text">
                            <a href="dexiemAnnee.php" class="btn_4"> الثانية ثانوي</a>
                            <div class="author_info">
                                <div class="author_img">
                                    <div class="author_info_text">
                                        <p>اختر تخصصك لتجد الأسئلة المناسبة لمستواك</p><br>
                                        <H5>الشعبةالتعليمية</H5>
                                        <ul class="navbar-nav align-items-start">
                                        <?php
              // Fetch Filières for the 2nd year
              $fetchFiliereQuery2 = "SELECT * FROM Filière WHERE year_id = 2";
              $fetchFiliereResult2 = $conn->query($fetchFiliereQuery2);
              if ($fetchFiliereResult2->num_rows > 0) {
                while ($row2 = $fetchFiliereResult2->fetch_assoc()) {
                    echo "<li><a href='dexiemAnnee.php?filiere=" . $row2['field_name'] . "'><i class='fas fa-arrow-left'></i>&nbsp;" . $row2['field_name'] . "</a></li>";
                }
              }
              ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6 col-lg-4" id="3st">
                    <div class="single_special_cource">
                        <img src="./assets/img/1.png" class="special_img text-center" width="70%" alt="">
                        <div class="special_cource_text">
                            <a href="troisiemeAnnee.php" class="btn_4"> الثالثة ثانوي</a>
                            
                            <div class="author_info">
                                <div class="author_img">
                                    <div class="author_info_text">
                                        <p>اختر تخصصك لتجد الأسئلة المناسبة لمستواك</p><br>
                                        <H5>الشعبةالتعليمية</H5>
                                        <ul class="navbar-nav align-items-start">
                                        <?php
              // Fetch Filières for the 2nd year
              $fetchFiliereQuery2 = "SELECT * FROM Filière WHERE year_id = 3";
              $fetchFiliereResult2 = $conn->query($fetchFiliereQuery2);
              if ($fetchFiliereResult2->num_rows > 0) {
                while ($row2 = $fetchFiliereResult2->fetch_assoc()) {
                    echo "<li><a href='troisiemeAnnee.php?filiere=" . $row2['field_name'] . "'><i class='fas fa-arrow-left'></i>&nbsp;" . $row2['field_name'] . "</a></li>";
                }
              }
              ?>
                                        </ul>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br>
   
<?php include "./includes/footer.php"?>