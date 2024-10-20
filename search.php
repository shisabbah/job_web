<?php
session_start();
include 'db.php';

$contractTypes = [
    1 => "CDD",
    2 => "CDI",
    3 => "Intérim",
    4 => "Stage",
    5 => "Alternance",
];

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';

$query = "SELECT a.id_annonce, a.nom AS titre, a.endroit, a.paye, a.id_contrat, a.description, a.temps, e.nom AS entreprise_nom, e.description AS short_desc, e.id_admin
          FROM annonces a
          JOIN entreprises e ON a.entreprise_id = e.id_entreprise
          WHERE 1 = 1";

if (!empty($keyword)) {
    $query .= " AND (a.nom LIKE '%$keyword%' OR e.nom LIKE '%$keyword%')";
}
if (!empty($location)) {
    $query .= " AND a.endroit LIKE '%$location%'";
}

$result = $conn->query($query);
if (!$result) {
    echo "Erreur dans la requête SQL: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche - Offres d'emploi</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function confirmDeletion(event) {
            if (!confirm("Êtes-vous sûr de vouloir supprimer cette annonce ?")) {
                event.preventDefault();
            }
        }

        function confirmPostuler(event) {
            if (!confirm("Êtes-vous sûr de vouloir de postuler pour cette annonce ?")) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body>
    <header>
        <div class="search-bar">
        <div class="logo">
                <a href="admin.php"><img src="logo" class="logo-img"alt="Logo Linktech"></a>
            </div>
            <form action="search.php" method="GET">
                <input type="text" id="keyword" name="keyword" placeholder="Rechercher..." value="<?= htmlspecialchars($keyword) ?>">
                <input type="text" id="location" name="location" placeholder="Lieu..." value="<?= htmlspecialchars($location) ?>">
                <button type="submit">Rechercher</button>
            </form>
            <div class="logout">
                <a href="logout.php"><img src="logout.png" class="logout"></a>
            </div>
        </div>
    </header>
    <section class="job-offers">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="job-card">
                <?php if ((isset($_SESSION['is_entreprise']) && $_SESSION['is_entreprise'] == true && $_SESSION['entreprise_nom'] == $row['entreprise_nom']) || (isset($_SESSION['superadmin']) && $_SESSION['superadmin'])): ?>
                    <form action="delete.php" method="POST" onsubmit="confirmDeletion(event)">
                        <input type="hidden" name="id_annonce" value="<?= $row['id_annonce'] ?>">
                        <button type="submit" class="delete-button">X</button>
                    </form>
                    <form action="annonce.php" method="POST">
                        <input type="hidden" name="id_annonce" value="<?= $row['id_annonce'] ?>">
                        <button type="submit" class="mod-button">M</button>
                    </form>
                <?php endif; ?>
                <h2><?= htmlspecialchars($row['titre']) ?></h2>
                <p><?= htmlspecialchars($row['entreprise_nom']) ?></p>
                <p><?= htmlspecialchars($row['endroit']) ?></p>
                <div class="details">
                    <span><?= htmlspecialchars($contractTypes[$row['id_contrat']]) ?></span>
                    <span><?= htmlspecialchars($row['paye']) ?>€</span>
                    <span><?= htmlspecialchars($row['temps']) ?></span>
                </div>
                <p class="short-text"><?= htmlspecialchars($row['short_desc']) ?></p>
                <p class="full-text" style="display: none;"><?= htmlspecialchars($row['description']) ?></p>
                <a href="#" class="apply-button" onclick="showFullText(event, this)">Voir plus</a>
                <?php if (isset($_SESSION['is_entreprise'])): ?>
                    <?php if ($_SESSION['is_entreprise'] || $_SESSION['superadmin']): ?>
                        <?php if($_SESSION['superadmin'] || $_SESSION['entreprise_nom'] == $row['entreprise_nom']): ?>
                            <form action="candidats.php" method="POST">
                                <input type="hidden" name="id_annonce" value="<?= $row['id_annonce'] ?>">
                                <button type="submit" class="apply-button">Candidats</button>
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <form action="candidat.php" method="POST" onsubmit="confirmPostuler(event)">
                            <input type="hidden" name="id_annonce" value="<?= $row['id_annonce'] ?>">
                            <?php
                                $stmt = $conn->prepare("SELECT * FROM candidatures WHERE annonce_id = ? AND candidat_id = ? LIMIT 1");
                                $stmt->bind_param('ii', $row['id_annonce'], $_SESSION['id_user']);
                                $stmt->execute();
                                $res = $stmt->get_result()->fetch_assoc();
                                if ($res) {
                                    echo '<p class="apply-button">Envoyée</p>';
                                } else {
                                    echo '<button type="submit" class="apply-button">Postuler</button>';
                                }
                                $stmt->close();
                            ?>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Aucune offre trouvée.</p>
        <?php endif; ?>
    </section>
    <?php if (isset($_SESSION['is_entreprise']) && $_SESSION['is_entreprise'] == true): ?>
        <div class="add-annonce-container">
            <a href="add_annonce.php" class="add-annonce-btn">Ajouter une offre</a>
        </div>
    <?php endif; ?>
    <script>
        function showFullText(event, element) {
            event.preventDefault();
            const card = element.closest('.job-card');
            const shortText = card.querySelector('.short-text');
            const fullText = card.querySelector('.full-text');

            if (fullText.style.display === 'none') {
                shortText.style.display = 'none';
                fullText.style.display = 'block';
                element.innerText = 'Voir moins';
            } else {
                shortText.style.display = 'block';
                fullText.style.display = 'none';
                element.innerText = 'Voir plus';
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>