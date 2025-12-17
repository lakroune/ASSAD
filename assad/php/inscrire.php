<?php

include "../db_connect.php";

if (
    $_SERVER['REQUEST_METHOD'] === "POST" &&
    isset($_POST['full-name'], $_POST['role'], $_POST['reg-email'], $_POST['reg-password'])
) {

    $fullName = $_POST['full-name'];
    $role = $_POST['role'];
    $email = $_POST['reg-email'];
    $password = $_POST['reg-password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO utilisateurs (nom_utilisateur, role, email, motpasse_hash) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);



    $stmt->bind_param("ssss", $fullName, $role, $email, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: ../connexion.php?message=user_added");
    } else {

        header("Location: ../connexion.php?error=4");
    }

    $stmt->close();
} else {
    header("Location: ../connexion.php?error=2");
    exit();
}
