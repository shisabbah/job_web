<?php
session_start();
include 'db.php';

if ((isset($_SESSION['superadmin']) && $_SESSION['superadmin'])) {
    $sql = "SELECT id_user, nom, prenom, mail, telephone FROM users WHERE 1 = 1";
    $result = mysqli_query($conn, $sql);
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
            if (!confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
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
        <h2 class="inscription-title">Utilisateurs</h2>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php if($row['id_user'] != 2 && $row['id_user'] != 3): ?>
                    <div class="input-container">
                        <h3><?= htmlspecialchars($row['prenom']) ?> <?= htmlspecialchars($row['nom']) ?> | <?= htmlspecialchars($row['mail']) ?> | <?= htmlspecialchars($row['telephone']) ?></h3>
                        <form action="delete.php" method="POST" onsubmit="confirmDeletion(event)">
                            <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                            <button type="submit" class="delete-button">Supprimer utilisateur</button>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="input-container">
                <h3>Aucun  utilisateur trouvé</h3>
            </div>
        <?php endif; ?>
    </div>

    <button type="submit"><a href="admin.php">Retour</a></button>
</div>
</body>
</html>

<?php
$conn->close();
?>