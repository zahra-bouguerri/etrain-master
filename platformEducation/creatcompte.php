<?php
include "./config/connexion.php";

if (isset($_POST['signin'])) {
    // Signup logic
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $niveau = $_POST['niveau'];
    $email = $_POST['email'];
    $motPass = $_POST['motPass'];
    $hashed_password = password_hash($motPass, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM etudiant WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        echo "<script>alert('Email already exists');</script>";
        echo "<script>window.location.href='login.php';</script>";
        exit();
    }

    $sql = "INSERT INTO etudiant(nom, prenom, email, annee, motPass) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $nom, $prenom, $email, $niveau, $hashed_password);
    $success = $stmt->execute();

    if ($success) {
        echo "<script>alert('Your email has been registered successfully.');</script>";
        echo "<script>window.location.href='index.php';</script>";
        exit();
    } else {
        echo "<script>alert('Please try again later.');</script>";
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }
}
?>