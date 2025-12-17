<?php
session_start();
include "../../db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id_utilisateur'])) {
    $id_visite = intval($_POST['id_visite']);
    $id_utilisateur = intval($_POST['id_utilisateur']);
    $nb_personnes = intval($_POST['nb_personnes']);

    $sql = "INSERT INTO reservations (id_visite, id_utilisateur, nb_personnes) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $id_visite, $id_utilisateur, $nb_personnes);

    if ($stmt->execute()) {
        header("Location: ../reservation.php?success=reserved");
    } else {
        header("Location: ../reservation.php?error=db_error");
    }
    exit();
}
