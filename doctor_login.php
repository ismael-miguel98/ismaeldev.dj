<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Médecin</title>
</head>
<body>
    <h2>Connexion Médecin</h2>
    <form action="doctor_authenticate.php" method="post">
        <label for="username">Nom d'utilisateur:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Se connecter">
    </form>
    <?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connexion à la base de données (exemple avec MySQL)
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "form";

    // Créer une connexion
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données: " . $conn->connect_error);
    }

    // Préparer la requête SQL pour vérifier les informations de connexion du médecin
    $sql = "SELECT * FROM conn_medecin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Vérifier si le résultat contient des lignes (si le médecin est authentifié)
    if ($result->num_rows > 0) {
        // Authentification réussie, rediriger vers la page d'administration
        header("Location: page_admin.php");
        exit();
    } else {
        // Authentification échouée, afficher un message d'erreur
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>

</body>
</html>
