<?php
// Informations de connexion à la base de données
$serveur = "localhost";
$utilisateur = "nom_utilisateur";
$mot_de_passe = "mot_de_passe";
$base_de_donnees = "nom_base_de_donnees";

// Connexion à la base de données
$connexion = pg_connect("host=db-serv.postgres.database.azure.com port=5432 dbname=postgres user=gwzbvjttiw password=G3g9kwrHhtLjQ$vW");

// Vérifier la connexion
if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Requête pour vérifier l'existence de l'utilisateur dans la base de données
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connexion, $query);

    // Vérifier si l'utilisateur existe
    if (mysqli_num_rows($result) > 0) {
        // L'utilisateur existe, faire quelque chose ici
        echo "Connexion réussie !";
    } else {
        // L'utilisateur n'existe pas, afficher un message d'erreur
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Fermer la connexion
mysqli_close($connexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <form method="POST" action="">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
