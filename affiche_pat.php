<?php
$serveur = "localhost";
$utilisateur = "root";
$modDePasse = "";
$base = "form";

$connect = mysqli_connect($serveur, $utilisateur, $modDePasse, $base);

// Récupérer tous les utilisateurs depuis la base de données
$query = "SELECT * FROM users";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <link rel="stylesheet" href="g.css">
    <link rel="stylesheet" href="c.css">
    <link rel="stylesheet" href="B.css">
   <style>body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;  /* Reduced width */
    text-align: center;
}

h1 {
    font-size: 1.2em;  /* Reduced font size */
    margin-bottom: 10px;  /* Reduced margin */
}

.form-group {
    margin-bottom: 10px;  /* Reduced margin */
    text-align: left;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
select {
    width: 100%;
    padding: 6px;  /* Reduced padding */
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"],
input[type="button"] {
    width: calc(100% - 20px);
    padding: 8px;  /* Reduced padding */
    margin: 5px 0;  /* Reduced margin */
    border: none;
    background-color: #007BFF;
    color: white;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover,
input[type="button"]:hover {
    background-color: #0056b3;
}

a {
    display: block;
    margin-top: 10px;  /* Added margin */
}
</style>
</head>
<body>
    <div class="container">
        <h1>AFFICHER TOUT LES PATIRNTS</h1>
        <form method="POST">
            <?php
            // Boucle pour afficher les champs pour chaque utilisateur
            while ($row = mysqli_fetch_assoc($result)) {
               
                @$nom = $row['username'];
                @$email = $row['email'];
                @$password = $row['password'];
            ?>
            <div class="user-form">
            <div class="form-group">
                  
                <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text"  name="username" value="<?php echo $nom; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email"  name="email" value="<?php echo $email; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD:</label>
                    <input type="text"  name="password" value="<?php echo $password; ?>" readonly>
                </div>
            </div>
            <?php
            }
            ?>
            
             
            <a href="gere les patients.html"><input type="button" name="retour" value="RETOUR  "></a>
            
        </form>
    </div>
</body>
</html>
