<?php
$serveur = "localhost";
$utilisateur = "root";
$modDePasse = "";
$base = "form";

$connect = mysqli_connect($serveur, $utilisateur, $modDePasse, $base);

// Vérifier la connexion
if (!$connect) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Récupérer tous les docteurs depuis la base de données
$query = "SELECT * FROM medecins";
$result = mysqli_query($connect, $query);

// Vérifier si la requête a réussi
if (!$result) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="B.css">
    <link rel="stylesheet" href="c.css">

    <title>Afficher tous les Medecins</title>
    <style>
       
        .footer{
    position: fixed;
    left: 0;
    bottom: 0%;
    width: 100%;
    height: 6%;
    background-color: #333;
    color: white;
    text-align: center;
}

        .container {
            background-color: #fff;
            margin-top: 80px;
            margin-left: 300px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        input[type="button"] {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: red;
            color: #fff;
            transition: background-color 0.3s;
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        input[type="button"]:hover {
            background-color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>AFFICHER TOUS LES DOCTEURS</h1>
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Spécialité</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['nom']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['specialite']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>Aucun docteur trouvé.</p>
        <?php endif; ?>
        <a href="gere les docteurs.html"><input type="button" name="retour" value="Quitte"></a>
    </div>
</body>
<footer class="footer">
      <p> @copy_right Afficher Les Medecins</p>
</footer>
</html>
