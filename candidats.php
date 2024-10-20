<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_annonce']) && (isset($_SESSION['entreprise_id']) || (isset($_SESSION['superadmin']) && $_SESSION['superadmin']))) {
        $id_annonce = $_POST['id_annonce'];

        $sql = "SELECT c.date_candidature AS date, c.id_candidature, u.nom, u.prenom, u.mail, u.telephone
        FROM candidatures c
        JOIN users u ON c.candidat_id = u.id_user
        WHERE annonce_id='$id_annonce'";

        $result = mysqli_query($conn, $sql);

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
    <script>
        function confirmDeletion(event) {
            if (!confirm("Êtes-vous sûr de vouloir supprimer cette candidature ?")) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body>
<div class="video-container">
    <div class="logo">
        <img src="logo" alt="Logo Linktech">
    </div>
    <div class="inscription-container">
        <h2 class="inscription-title">Candidatures</h2>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="input-container">
                    <h3><?= htmlspecialchars($row['prenom']) ?> <?= htmlspecialchars($row['nom']) ?> | <?= htmlspecialchars($row['mail']) ?> | <?= htmlspecialchars($row['telephone']) ?></h3>
                    <h3><?= htmlspecialchars($row['date']) ?></h3>
                    <form action="delete.php" method="POST" onsubmit="confirmDeletion(event)">
                        <input type="hidden" name="id_candidature" value="<?= $row['id_candidature'] ?>">
                        <button type="submit" class="delete-button">Supprimer candidature</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="input-container">
                <h3>Aucun  candidat trouvé</h3>
            </div>
        <?php endif; ?>
    </div>

    <button type="submit"><a href="search.php">Retour</a></button>
</div>
</body>
</html>

<?php
$conn->close();
?>