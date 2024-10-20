<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Nettoyage des données
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Requête pour vérifier l'utilisateur
    $check_user_query = "SELECT * FROM users WHERE mail='$email' AND password='$password'";
    $result = mysqli_query($conn, $check_user_query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        // Stocker les informations dans la session
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['mail'] = $user['mail'];
        
        if ($_SESSION['id_user'] == 2 || $_SESSION['id_user'] == 3) {
            $_SESSION['superadmin'] = true;
        } else {
            $_SESSION['superadmin'] = false;
        }

        // Vérification si l'utilisateur est aussi un administrateur d'entreprise
        $check_entreprise_query = "SELECT * FROM entreprises WHERE id_admin = " . $user['id_user'];
        $resultEntreprise = mysqli_query($conn, $check_entreprise_query);

        if (mysqli_num_rows($resultEntreprise) == 1) {
            $entreprise = mysqli_fetch_assoc($resultEntreprise);
            $_SESSION['is_entreprise'] = true;
            $_SESSION['entreprise_id'] = $entreprise['id_entreprise'];
            $_SESSION['entreprise_nom'] = $entreprise['nom'];
            $_SESSION['entreprise_desc'] = $entreprise['description'];
        } else {
            $_SESSION['is_entreprise'] = false;
        }

        // Redirection après connexion réussie
        header('Location: search.php');
        exit();
    } else {
        echo "Erreur: Email ou mot de passe incorrect.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="connection.css">
</head>
<body>
    <div class="video-container">
        <div class="logo">
            <img src="logo" alt="Logo Linktech">
        </div>
        <div class="inscription-container">
            <h2 class="inscription-title">Connexion</h2>
            <form action="" method="POST">
                <div class="input-container">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-container">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>
                <button type="submit" class="submit-btn">Se connecter</button>
            </form>
            <p>Vous n'avez pas encore de compte? <a href="login.php">Inscrivez-vous ici</a></p>
        </div>
    </div>
</body>
</html>
