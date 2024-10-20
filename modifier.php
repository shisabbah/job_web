<?php
session_start();
include 'db.php';

if (!isset($_SESSION['id_user'])) {
    header('Location: index.php');
    exit();
}

$id_user = $_SESSION['id_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $field = $_POST['field'];
    $value = mysqli_real_escape_string($conn, $_POST['value']);

    if ($field == 'entreprise_nom') {
        $entreprise_id = $_SESSION['entreprise_id'];
        $sql = "UPDATE entreprises SET nom='$value' WHERE id_entreprise='$entreprise_id'";
        mysqli_query($conn, $sql);
        $_SESSION['entreprise_nom'] = $value;
    } elseif ($field == 'entreprise_desc') {
        $entreprise_id = $_SESSION['entreprise_id'];
        $sql = "UPDATE entreprises SET description='$value' WHERE id_entreprise='$entreprise_id'";
        mysqli_query($conn, $sql);
    } elseif ($field == 'nom' || $field == 'prenom' || $field == 'telephone' || $field == 'mail' || $field == 'password') {
        $sql = "UPDATE users SET $field='$value' WHERE id_user='$id_user'";
        mysqli_query($conn, $sql);
    } elseif ($field == 'a_nom' || $field == 'a_description' || $field == 'a_endroit' || $field == 'a_paye' || $field == 'a_id_contrat') {
        $id = $_POST['id_annonce'];
        $new_field = substr($field, 2);
        $sql = "UPDATE annonces SET $new_field='$value' WHERE id_annonce='$id'";
        mysqli_query($conn, $sql);
    }
    
    mysqli_close($conn);
    echo 'Données mises à jour avec succès.';
} else {
    echo 'Méthode non autorisée.';
}
?>

