<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_annonce']) && (isset($_SESSION['entreprise_id']) || $_SESSION['superadmin'])) {
        $id_annonce = $_POST['id_annonce'];

        $query = "DELETE FROM annonces WHERE id_annonce = '$id_annonce'";
        $stmt = $conn->prepare($query);

        if ($stmt->execute()) {
            header("Location: search.php");
        } else {
            echo "Erreur lors de la suppression de l'annonce : " . $conn->error;
        }
        $stmt->close();

    } elseif (isset($_POST['id_candidature']) && (isset($_SESSION['entreprise_id']) || $_SESSION['superadmin'])) {
        $id_candidature = $_POST['id_candidature'];

        $query = "DELETE FROM candidatures WHERE id_candidature = '$id_candidature'";
        $stmt = $conn->prepare($query);

        if ($stmt->execute()) {
            header("Location: search.php");
        } else {
            echo "Erreur lors de la suppression de la candidature : " . $conn->error;
        }
        $stmt->close();

    } elseif (isset($_POST['id_user']) && isset($_SESSION['superadmin'])) {
        $user = $_POST['id_user'];

        $query = "SELECT id_entreprise FROM entreprises WHERE id_admin = '$user'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id_entreprise);
        $stmt->fetch();
        $stmt->close();
        
        if ($id_entreprise) {

            $query = "DELETE FROM annonces WHERE entreprise_id = '$id_entreprise'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->close();
        
            $query = "DELETE FROM entreprises WHERE id_entreprise = '$id_entreprise'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->close();

        } else {
            $query = "DELETE FROM candidatures WHERE candidat_id = '$user'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->close();
        }

        $query = "DELETE FROM users WHERE id_user = '$user'";
        $stmt = $conn->prepare($query);

        if ($stmt->execute()) {
            header("Location: users.php");
        } else {
            echo "Erreur lors de la suppression de la candidature : " . $conn->error;
        }
        $stmt->close();

    } else {
        echo "Paramètres invalides.";
    }
}

$conn->close();
?>
