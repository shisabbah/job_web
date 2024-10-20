<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_annonce']) && (isset($_SESSION['entreprise_id']) || (isset($_SESSION['superadmin']) && $_SESSION['superadmin']))) {
        $id_annonce = $_POST['id_annonce'];

        $sql = "SELECT nom, paye, endroit, description, id_contrat FROM annonces WHERE id_annonce='$id_annonce'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $annonce = mysqli_fetch_assoc($result);
            $titre = htmlspecialchars($annonce['nom']);
            $description = htmlspecialchars($annonce['description']);
            $lieu = htmlspecialchars($annonce['endroit']);
            $paye = htmlspecialchars($annonce['paye']);
            $contrat = htmlspecialchars($annonce['id_contrat']);
        } else {
            $titre = '???';
            $description = '???';
            $lieu = '???';
            $paye = '???';
            $contrat = '1';
        }

    } else {
        echo "Paramètres invalides.";
    }
} else {
    header("Location: search.php");
}
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
        <h2 class="inscription-title">Modifier l'annonce</h2>
        <div class="input-container">
            <h3>Titre: 
                <span id="titre" contenteditable="true" onblur="updateInfo('a_nom', this.innerText, <?php echo $id_annonce; ?>)"><?php echo $titre; ?></span>
            </h3>
        </div>

        <div class="input-container">
            <h3>Description: 
                <span id="description" contenteditable="true" onblur="updateInfo('a_description', this.innerText, <?php echo $id_annonce; ?>)"><?php echo $description; ?></span>
            </h3>
        </div>

        <div class="input-container">
            <h3>Lieu: 
                <span id="lieu" contenteditable="true" onblur="updateInfo('a_endroit', this.innerText, <?php echo $id_annonce; ?>)"><?php echo $lieu; ?></span>
            </h3>
        </div>

        <div class="input-container">
            <h3>Paye: 
                <span id="paye" contenteditable="true" onblur="updateInfo('a_paye', this.innerText, <?php echo $id_annonce; ?>)"><?php echo $paye; ?></span>
            </h3>
        </div>

        <select onchange="updateInfo('a_id_contrat', this.value, <?php echo $id_annonce; ?>)">
            <option value="1" <?php echo ($contrat == 1) ? 'selected' : ''; ?>>CDD</option>
            <option value="2" <?php echo ($contrat == 2) ? 'selected' : ''; ?>>CDI</option>
            <option value="3" <?php echo ($contrat == 3) ? 'selected' : ''; ?>>Intérim</option>
            <option value="4" <?php echo ($contrat == 4) ? 'selected' : ''; ?>>Stage</option>
            <option value="5" <?php echo ($contrat == 5) ? 'selected' : ''; ?>>Alternance</option>
        </select>

        <button type="submit"><a href="search.php">Retour</a></button>
    </div>
</div>

<script>
    function updateInfo(field, value, id_annonce) {
        $.ajax({
            url: 'modifier.php',
            type: 'POST',
            data: {
                field: field,
                value: value,
                id_annonce: id_annonce
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

<?php
$conn->close();
?>