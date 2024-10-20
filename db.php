<?php
// db.php - Connexion à la base de données
$servername = 'localhost';
$dbname = 'job_web';
$username = 'root';
$pass = '';
$charset = 'utf8mb4';

$conn = new mysqli($servername, $username, $pass, $dbname);

?>
