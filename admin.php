<?php
include 'db.php';
session_start();
if (!isset($_SESSION['id_user'])) {
    header('Location: index.php');
    exit();
}

$id_user = $_SESSION['id_user'];
$sql = "SELECT nom, prenom, telephone, mail, password FROM users WHERE id_user='$id_user'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $nom = htmlspecialchars($user['nom']);
    $prenom = htmlspecialchars($user['prenom']);
    $tel = htmlspecialchars($user['telephone']);
    $mail = htmlspecialchars($user['mail']);
    $pwd = htmlspecialchars($user['password']);
} else {
    $nom = 'Nom inconnu';
    $prenom = 'Prénom inconnu';
}

if (isset($_SESSION['entreprise_id'])) {
    $entreprise_id = $_SESSION['entreprise_id'];
    $sql = "SELECT nom, description FROM entreprises WHERE id_entreprise='$entreprise_id'";
    $resultEntreprise = mysqli_query($conn, $sql);
    
    if ($resultEntreprise && mysqli_num_rows($resultEntreprise) > 0) {
        $entreprise = mysqli_fetch_assoc($resultEntreprise);
        $entreprise_nom = htmlspecialchars($entreprise['nom']);
        $entreprise_desc = htmlspecialchars($entreprise['description']);
    } else {
        $entreprise_nom = 'Nom d\'entreprise inconnu';
        $entreprise_desc = 'Description inconnue';
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification des informations</title>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="video-container">
    <div class="logo">
        <img src="logo" alt="Logo Linktech">
    </div>
    <div class="inscription-container">
        <h2 class="inscription-title">Informations Personnelles</h2>

        <div class="input-container">
            <h3>Nom: 
                <span id="nom" contenteditable="true" onblur="updateInfo('nom', this.innerText)"><?php echo $nom; ?></span>
            </h3>
        </div>       

        <div class="input-container">
            <h3>Prenom:
                <span id="prenom" contenteditable="true" onblur="updateInfo('prenom', this.innerText)"><?php echo $prenom; ?></span>
            </h3>
        </div>    

        <div class="input-container">
            <h3>Mail:
                <span id="mail" contenteditable="true" onblur="updateInfo('mail', this.innerText)"><?php echo $mail; ?></span>
            </h3>
        </div>       

        <div class="input-container">
            <h3>Téléphone: 
                <span id="telephone" contenteditable="true" onblur="updateInfo('telephone', this.innerText)"><?php echo $tel; ?></span>
            </h3>
        </div>
        
        <div class="input-container">
            <h3>Mot de passe: 
                <span id="password" contenteditable="true" onblur="updateInfo('password', this.innerText)"><?php echo $pwd; ?></span>
            </h3>
        </div> 

        <?php if (isset($_SESSION['is_entreprise']) && $_SESSION['is_entreprise'] == true): ?>
            <h2 class="inscription-title">Informations Entreprise</h2>
            <div class="input-container">
                <h3>Entreprise:
                <span id="entreprise_nom" contenteditable="true" onblur="updateInfo('entreprise_nom', this.innerText)"><?php echo $entreprise_nom; ?></span>
            </h3>
        </div>        
            <div class="input-container">
                <h3>Description: 
                <span id="entreprise_desc" contenteditable="true" onblur="updateInfo('entreprise_desc', this.innerText)"><?php echo $entreprise_desc; ?></span>
                </h3>
            </div>  
        <?php endif; ?>

        <?php if((isset($_SESSION['superadmin']) && $_SESSION['superadmin'])): ?>
            <button type="submit"><a href="users.php">Gérer les utilisateurs</a></button>
        <?php endif; ?>

        <button type="submit"><a href="search.php">Retour</a></button>
    </div>
</div>

<script>
function updateInfo(field, value) {
    $.ajax({
        url: 'modifier.php',
        type: 'POST',
        data: {
            field: field,
            value: value
        },
        success: function(response) {
            console.log('Données mises à jour avec succès');
        },
        error: function() {
            console.log('Erreur lors de la mise à jour');
        }
    });
}
</script>

</body>
</html>
