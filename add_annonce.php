<?php
include 'db.php';
session_start();

if (!isset($_SESSION['entreprise_id']) || !isset($_SESSION['entreprise_id'])) {
    echo "Erreur: Vous devez être connecté pour ajouter une annonce.";
    exit;
}

$entreprise_id = $_SESSION['entreprise_id'];

$result = $conn->query("SELECT id_contrat, nom FROM types_contrat");
$contrats = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $contrats[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $endroit = $_POST['endroit'];
    $temps = $_POST['temps'];
    $paye = $_POST['paye'];
    $id_contrat = $_POST['id_contrat'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO annonces (nom, temps, paye, endroit, entreprise_id, id_contrat, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissis", $nom, $temps, $paye, $endroit, $entreprise_id, $id_contrat, $description);

    if ($stmt->execute()) {
        echo "Annonce ajoutée avec succès!";
    } else {
        echo "Erreur: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une annonce</title>
    <link rel="stylesheet" href="add_annonce.css">
</head>
<body>
    <div class="inscription-container">
        <h1>Ajouter une nouvelle annonce</h1>
        <form action="" method="POST">
            <div class="input-container">
                <label for="nom" class="inscription-title">Nom de l'annonce:</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="input-container">
                <label for="endroit" class="inscription-title">Lieu:</label>
                <input type="text" id="endroit" name="endroit" required>
            </div>

            <div class="input-container">
                <label for="temps" class="inscription-title">Date:</label>
                <input type="date" id="temps" name="temps" required>
            </div>

            <div class="input-container">
                <label for="paye" class="inscription-title">Salaire:</label>
                <input type="number" id="paye" name="paye" required>
            </div>

            <div class="input-container">
                <label for="id_contrat" class="inscription-title">Type de contrat:</label>
                <select id="id_contrat" name="id_contrat" required>
                    <?php foreach ($contrats as $contrat): ?>
                        <option value="<?php echo $contrat['id_contrat']; ?>"><?php echo $contrat['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-container">
                <label for="description" class="inscription-title">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Ajouter l'annonce</button>
            <div>
                <a href="search.php"><button type="button" class="submit-btn">Retour</button></a>
            </div>
        </form>
    </div>
</body>
</html>

