<?php
include "./config/connexion.php";

$currentYear = date('Y');
if (isset($_POST['signin'])) {
    // Signup logic
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $niveau = $_POST['niveau'];
    $email = $_POST['email'];
    $motPass = $_POST['motPass'];
    $hashed_password = password_hash($motPass, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM étudiant WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        echo "<script>alert('البريد الالكتروني موجود بالفعل');</script>";
        echo "<script>window.location.href='login.php';</script>";
        exit();
    }

    $sql = "INSERT INTO étudiant(nom, prenom, email, annee, motPass,anneereg) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $nom, $prenom, $email, $niveau, $hashed_password,$currentYear);
    $success = $stmt->execute();

    if ($success) {
        echo "<script>alert('تم انشاء حسابك.');</script>";
        echo "<script>window.location.href='index.php';</script>";
        exit();
    } else {
        echo "<script>alert('Please try again later.');</script>";
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }
}
?>