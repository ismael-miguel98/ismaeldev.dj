<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envoyer demande de rendez-vous</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="time"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="#888" viewBox="0 0 24 24" width="18" height="18" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 20px;
        }

        input[type="submit"],
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            display: inline-block;
            text-decoration: none;
            text-align: center;
        }

        input[type="submit"]:hover,
        .button:hover {
            background-color: #45a049;
        }

        a.button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            text-align: center;
        }

        a.button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Envoyer demande de rendez-vous aux médecins</h1>
        <form method="post">
            <label for="nom_patient">Nom du patient:</label>
            <input type="text" id="nom_patient" name="nom_patient" required>
            
            <label for="email_patient">Email du patient:</label>
            <input type="email" id="email_patient" name="email_patient" required>
            
            <label for="date_rdv">Date du rendez-vous:</label>
            <input type="date" id="date_rdv" name="date_rdv" required>
            
            <label for="horaire_rdv">Horaire du rendez-vous:</label>
            <input type="time" id="horaire_rdv" name="horaire_rdv" required>
            
            <label for="type_rdv">Type de rendez-vous:</label>
            <select id="type_rdv" name="type_rdv" required>
                <option value="Consultation">Consultation</option>
                <option value="Examens">Examens</option>
                <option value="Suivi">Suivi</option>
            </select>
            
            <label for="medecin_souhaite">Médecin souhaité:</label>
            <input type="text" id="medecin_souhaite" name="medecin_souhaite" required>
            
            <input type="submit" value="Envoyer demande">
        </form>
        <a href="liste_rendez-vous.php" class="button">Voir la liste des rendez-vous</a>
    </div>
</body>

</html>
