<?php
session_start();
include "../../db_connect.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['role_utilisateur'] !== "visiteur") {
    header("Location: ../../connexion.php?error=unauthorized");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $id_visite = intval($_POST['id_visite']);
    $note = intval($_POST['note']);
    $commentaire = htmlspecialchars($_POST['commentaire']);

    $check_sql = "SELECT r.id_reservations, v.dateheure_viste 
                  FROM reservations r 
                  INNER JOIN visitesguidees v ON r.id_visite = v.id_visite 
                  WHERE r.id_visite = $id_visite AND r.id_utilisateur = $id_utilisateur";

    $result = $conn->query($check_sql);
    $data = $result->fetch_assoc();

    if ($result->num_rows > 0 && strtotime($data['dateheure_viste']) < time()) {

        $insert_sql = "INSERT INTO commentaires (id_visite, id_utilisateur, note, texte, date_commentaire) 
                       VALUES ($id_visite, $id_utilisateur, $note, '$commentaire', NOW())";

        if ($conn->query($insert_sql)) {
            header("Location: ../visite_details.php?id=$id_visite&success=avis_ajoute");
        } else {
            header("Location: ../visite_details.php?id=$id_visite&error=db_error");
        }
    } else {
        header("Location: ./../visite_details.php?id=$id_visite&error=not_allowed");
    }
} else {
    header("Location: ../index.php");
}
