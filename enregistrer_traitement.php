<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez si la connexion a réussi
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Vérifiez si des données ont été soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si le nom du patient et le traitement ont été fournis
    if (isset($_POST['nom_patient']) && isset($_POST['traitement']) && !empty($_POST['nom_patient']) && !empty($_POST['traitement'])) {
        // Récupérez le nom du patient et le traitement soumis par le formulaire
        $nom_patient = $conn->real_escape_string($_POST['nom_patient']); 
        $traitement = $conn->real_escape_string($_POST['traitement']);

        // Préparez la requête SQL pour insérer le traitement recommandé dans la table traitement_diagnostic
        $sql = "INSERT INTO traitement_diagnostic (nom_patient, traitement) VALUES ('$nom_patient', '$traitement')";

        // Exécutez la requête SQL
        if ($conn->query($sql) === TRUE) {
            echo "Traitement recommandé enregistré avec succès pour le patient avec son nom : " .$nom_patient ;
        } else {
            echo "Erreur lors de l'enregistrement du traitement : " . $conn->error;
        }

    } else {
        // Si le nom du patient ou le traitement n'ont pas été fournis, affichez un message d'erreur
        echo "Veuillez fournir le nom du patient et le traitement.";
    }
} else {
    // Si les données n'ont pas été soumises via la méthode POST, affichez un message d'erreur
    echo "Une erreur s'est produite lors de la soumission du formulaire.";
}

// Fermez la connexion à la base de données
$conn->close();
?>
