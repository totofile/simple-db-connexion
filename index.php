<?php
// Connexion à la base de données avec une connexion string Azure

$connexionSTRING = getenv('AZURE_POSTGRESQL_CONNECTIONSTRING');
$connectionString = $connectionSTRING;
$username = "gwzbvjttiw";
$password = "G3g9kwrHhtLjQ$vW";

try {
    $conn = new PDO($connectionString, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données.";
} catch(PDOException $e) {
    die("Échec de la connexion à la base de données : " . $e->getMessage());
}

// Fonction pour enregistrer un message de journal
function logMessage($message) {
    global $conn;

    // Échapper les caractères spéciaux pour éviter les injections SQL
    $message = $conn->quote($message);

    // Insérer le message dans la table de journal
    $sql = "INSERT INTO logs (message) VALUES ($message)";
    try {
        $conn->exec($sql);
        echo "Message enregistré avec succès.";
    } catch(PDOException $e) {
        echo "Erreur lors de l'enregistrement du message : " . $e->getMessage();
    }
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Appeler la fonction logMessage avec les valeurs du formulaire
    logMessage("Username: $username, Password: $password");
}

// Fermer la connexion à la base de données
$conn = null;
?>
