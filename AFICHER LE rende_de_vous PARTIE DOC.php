<?php
$serveur = "localhost";
$utilisateur = "root";
$modDePasse = "";
$base = "form";

$connect = mysqli_connect($serveur, $utilisateur, $modDePasse, $base);

// Récupérer tous les utilisateurs depuis la base de données
$query = "SELECT * FROM rendez_vous_docteur";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="c.css">
    <link rel="stylesheet" href="B.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-Vous_Docteurs</title>
    <link rel="stylesheet" href="lad.css">
    <link rel="stylesheet" href="style copy 2.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .user-form {
            margin-bottom: 20px;
        }
        .button-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Afficher les informtion du docteur</h1>
        <form method="POST">
            <?php
            // Boucle pour afficher les champs pour chaque utilisateur
            while ($row = mysqli_fetch_assoc($result)) {
               
                $nom = $row['doctor_name'];
                $email = $row['email'];
                $docteur = $row['specialty'];
                $date = $row['disponibilite'];
                $HEURE = $row['max_patients'];
                ?>



            <div class="user-form">
            <div class="form-group">
                  
                <div class="form-group">
                    <label for="name">Nom du Docteur:</label>
                    <input type="text"  name="nom" value="<?php echo $nom; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email"  name="email" value="<?php echo $email; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="Specialite">Specialite de Docteur:</label>
                    <input type="texte"  name="docteur" value="<?php echo $docteur; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="password">Date et l'heur:</label>
                    <input type="text"  name="date" value="<?php echo $date; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="password">Le nombre des patient par jour:</label>
                    <input type="text"  name="HEURE" value="<?php echo $HEURE; ?>" readonly>
                </div>
            </div>
            <?php
            }
            ?>
            
             
            <a href="GERE LES REND-VOUS.html"><input type="button" name="retour" value="RETOUR  "></a>
            
        </form>
    </div>
</body>
</html>
