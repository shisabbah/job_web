<?php
session_start();
include 'db.php';

if (!isset($_SESSION['mail'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_annonce'])) {
        $annonce_id = $_POST['id_annonce'];

        $user_email = $_SESSION['mail'];

        $stmt = $conn->prepare("SELECT id_user FROM users WHERE mail = ?");
        if ($stmt === false) {
            die('Erreur de préparation de la requête : ' . $conn->error);
        }

        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user_row = $result->fetch_assoc();
            $user_id = $user_row['id_user'];

            $date_candidature = date('Y-m-d');

            $insert_stmt = $conn->prepare("INSERT INTO candidatures (annonce_id, candidat_id, date_candidature) VALUES (?, ?, ?)");
            if ($insert_stmt === false) {
                die('Erreur de préparation de la requête d\'insertion : ' . $conn->error);
            }

            $insert_stmt->bind_param("iis", $annonce_id, $user_id, $date_candidature);
            if ($insert_stmt->execute()) {
                echo "Candidature soumise avec succès.";
                header('Location: search.php');
                exit();
            } else {
                echo "Erreur lors de la soumission : " . $conn->error;
            }
            $insert_stmt->close();
        } else {
            echo "Utilisateur non trouvé.";
        }
        $stmt->close();
    } else {
        echo "Erreur : L'ID de l'annonce n'est pas défini.";
    }
}
$conn->close();
?>
