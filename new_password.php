<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "form";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Vérifier le token
    $sql = "SELECT email FROM password_resets WHERE token = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($email) {
        // Hacher le nouveau mot de passe
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Mettre à jour le mot de passe dans la base de données
        $sql = "UPDATE administrator SET password = ? WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $email);
        mysqli_stmt_execute($stmt);

        // Supprimer le token
        $sql = "DELETE FROM password_resets WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        echo "Votre mot de passe a été mis à jour avec succès.";
    } else {
        echo "Le token est invalide.";
    }

    // Fermer la connexion
    mysqli_close($conn);
} else {
    // Afficher le formulaire pour entrer le nouveau mot de passe
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        echo '<form action="new_password.php" method="post">
                <input type="hidden" name="token" value="' . $token . '">
                <label for="new_password">Nouveau mot de passe :</label>
                <input type="password" id="new_password" name="new_password" required><br>
                <input type="submit" value="Réinitialiser le mot de passe">
              </form>';
    } else {
        echo "Token manquant.";
    }
}
?>
