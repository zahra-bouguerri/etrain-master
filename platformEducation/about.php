<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include "./config/connexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Email address verification function, do not edit
    function isEmail($email) {
        return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
    }

    // Set a constant for the PHP_EOL (end of line) character
    if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

    $first_name = $_POST['nom'];
    $email = $_POST['email'];
    $comments = $_POST['message'];

    if (empty($first_name)) {
        echo '<div class="error_message">Attention ! Vous devez entrer votre nom.</div>';
        exit();
    } else if (empty($email)) {
        echo '<div class="error_message">Attention ! Veuillez entrer une adresse e-mail valide.</div>';
        exit();
    } else if (!isEmail($email)) {
        echo '<div class="error_message">Attention ! Vous avez saisi une adresse e-mail invalide, veuillez réessayer.</div>';
        exit();
    }

    if (empty($comments)) {
        echo '<div class="error_message">Attention ! Veuillez entrer votre message.</div>';
        exit();
    }

    // Load PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Enable SMTP
        $mail->isSMTP();

        // Set the SMTP server to send through
        $mail->Host       = 'smtp.gmail.com';

        // Enable SMTP authentication
        $mail->SMTPAuth   = true;

        // SMTP username
        $mail->Username   = 'mathprof214@gmail.com';

        // SMTP password
        $mail->Password   = 'fffoaqltvttnxnkc';

        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->SMTPSecure = 'ssl';

        // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->Port       = 465;

        // Set sender and recipient
        $mail->setFrom($email);
        $address = 'recipient@example.com';
       $mail->addAddress($address);

          // Définition du sujet de l'e-mail
          $mail->Subject = 'Vous avez ete contacte par ' . $first_name . '.';

          // Définition du corps de l'e-mail
          $mail->Body    = "Vous avez ete contacte par $first_name." . PHP_EOL . PHP_EOL . "\"$comments\"" . PHP_EOL . PHP_EOL . "Vous pouvez contacter $first_name par e-mail : $email ";
  
          // Envoi de l'e-mail
          $mail->send();
  
          // L'e-mail a été envoyé avec succès, affichage du message de réussite.
        
        
      } catch (Exception $e) {
          // Erreur lors de l'envoi de l'e-mail.
          echo '<div class="error_message">ERREUR ! Impossible d\'envoyer l\'e-mail. Veuillez réessayer ultérieurement.</div>';
      }
  }
  ?>

<?php include "./includes/header.php"?>

    <!-- Header part end-->

    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>حولنا</h2>
                            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">الرئيسية <i class="fa fa-chevron-left"></i></a></span> <span> حول الموقع<i class="fa fa-chevron-left"></i></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

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
                    <span class="counter"><?php echo getCountByNiveau("الثانية ثانوي"); ?></span>
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

<?php include "./includes/footer.php"?>