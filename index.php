<?php
// Connexion à la base de données
$servername = "localhost";
$username = "nom_utilisateur";
$password = "mot_de_passe";
$dbname = "nom_base_de_données";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Fonction pour enregistrer un message de journal
function logMessage($message) {
    global $conn;

    // Échapper les caractères spéciaux pour éviter les injections SQL
    $message = $conn->real_escape_string($message);

    // Insérer le message dans la table de journal
    $sql = "INSERT INTO logs (message) VALUES ('$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Message enregistré avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement du message : " . $conn->error;
    }
}

// Exemple d'utilisation de la fonction logMessage
logMessage("Ce message sera enregistré dans la base de données.");

// Fermer la connexion à la base de données
$conn->close();
?>