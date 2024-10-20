<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $type_utilisateur = isset($_POST['type_utilisateur']) ? $_POST['type_utilisateur'] : '';

    $prenom = mysqli_real_escape_string($conn, $prenom);
    $nom = mysqli_real_escape_string($conn, $nom);
    $email = mysqli_real_escape_string($conn, $email);
    $telephone = mysqli_real_escape_string($conn, $telephone);
    $password = mysqli_real_escape_string($conn, $password);
    $type_utilisateur = mysqli_real_escape_string($conn, $type_utilisateur);
    $check_email_query = "SELECT * FROM users WHERE mail='$email'";
    $result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($result) > 0) {
        echo "Erreur: cet email est déjà utilisé. Veuillez utiliser un autre email.";
    } else {
        $sql = "INSERT INTO users (nom, prenom, mail, telephone, password) VALUES ('$nom', '$prenom', '$email', '$telephone', '$password')";

        if (mysqli_query($conn, $sql)) {
            $user_id = mysqli_insert_id($conn);

            if ($type_utilisateur == 'entreprise') {
                $nom_entreprise = isset($_POST['nom_entreprise']) ? mysqli_real_escape_string($conn, $_POST['nom_entreprise']) : '';
                $description_entreprise = isset($_POST['description_entreprise']) ? mysqli_real_escape_string($conn, $_POST['description_entreprise']) : '';

                $sql_entreprise = "INSERT INTO entreprises (id_admin, nom, description) VALUES ('$user_id', '$nom_entreprise', '$description_entreprise')";

                if (mysqli_query($conn, $sql_entreprise)) {
                    header('Location: index.php');
                    exit();
                } else {
                    echo "Erreur: " . $sql_entreprise . "<br>" . mysqli_error($conn);
                }
            } else {
                // L'utilisateur est un candidat, pas d'action supplémentaire nécessaire
                header('Location: index.php');
                exit();
            }
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="video-container">
<div class="logo">
            <img src="logo" alt="Logo Linktech">
        </div>
    <div class="inscription-container">
        <h2 class="inscription-title">Inscription</h2>
        <form action="" method="POST">
            <div class="input-container">
                <input type="text" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="input-container">
                <input type="text" name="nom" placeholder="Nom" required>
            </div>
            <div class="input-container">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-container">
                <input type="telephone" name="telephone" placeholder="Numéro" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="input-container">
                <label>
                    <input type="radio" name="type_utilisateur" value="candidat" required>
                    Candidat
                </label>
                <label>
                    <input type="radio" name="type_utilisateur" value="entreprise" required>
                    Entreprise
                </label>
            </div>
            <div class="input-container" id="entreprise-nom" style="display: none;">
                <input type="text" name="nom_entreprise" placeholder="Nom de l'entreprise">
            </div>
            <div class="input-container" id="entreprise-description" style="display: none;">
                <textarea name="description_entreprise" placeholder="Description de l'entreprise"></textarea>
            </div>

            <button type="submit" class="submit-btn">S'inscrire</button>
        </form>
        <p>Vous avez déjà un compte? <a href="index.php">Cliquez ici</a></p>
    </div>
</div>

<script>
    document.querySelectorAll('input[name="type_utilisateur"]').forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'entreprise') {
                document.getElementById('entreprise-nom').style.display = 'block';
                document.getElementById('entreprise-description').style.display = 'block';
            } else {
                document.getElementById('entreprise-nom').style.display = 'none';
                document.getElementById('entreprise-description').style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
