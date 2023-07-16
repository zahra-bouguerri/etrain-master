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
        
          echo "<fieldset style='border: 1px solid #ccc; padding: 10px;'>";
          echo "<div id='success_page' style='text-align: center;'>";
          echo "<h1 style='color: #333; font-size: 24px;'>تم إرسال البريد الإلكتروني بنجاح.</h1>";
          echo "<p style='color: #666; font-size: 16px; margin-bottom: 20px;'>شكرًا <strong>$first_name</strong>، تم إرسال رسالتك بنجاح.</p>";
          echo "</div>";
          echo "</fieldset>";
      } catch (Exception $e) {
          // Erreur lors de l'envoi de l'e-mail.
          echo '<div class="error_message">ERREUR ! Impossible d\'envoyer l\'e-mail. Veuillez réessayer ultérieurement.</div>';
      }
  }
  ?>