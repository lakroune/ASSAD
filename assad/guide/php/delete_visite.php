<?php
include "../../db_connect.php";
session_start();

if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: ../../connexion.php");
    exit();
}

$id_guide = $_SESSION['id_utilisateur'];

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_visite = intval($_GET['id']);
 
    try {
        $sqlEtapes = "DELETE FROM etapesvisite WHERE id_visite = ?";
        $stmtEtapes = $conn->prepare($sqlEtapes);
        $stmtEtapes->bind_param("i", $id_visite);
        $stmtEtapes->execute();

        $sqlEtapes = "DELETE FROM commentaires WHERE id_visite = ?";
        $stmtEtapes = $conn->prepare($sqlEtapes);
        $stmtEtapes->bind_param("i", $id_visite);
        $stmtEtapes->execute();


        $sqlEtapes = "DELETE FROM reservations WHERE id_visite = ?";
        $stmtEtapes = $conn->prepare($sqlEtapes);
        $stmtEtapes->bind_param("i", $id_visite);
        $stmtEtapes->execute();


        $sqlVisite = "DELETE FROM visitesguidees WHERE id_visite = ? AND id_guide = ?";
        $stmtVisite = $conn->prepare($sqlVisite);
        $stmtVisite->bind_param("ii", $id_visite, $id_guide);
        $stmtVisite->execute();

        if ($stmtVisite->affected_rows > 0) {
            $conn->commit();
            header("Location: ../mes_visites.php?msg=deleted");
        } else {
            $conn->rollback();
            header("Location: ../mes_visites.php?error=unauthorized");
        }
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
} else {

    header("Location: ../mes_visites.php");
}
