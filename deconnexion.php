<!-- deconnexion.php -->

<?php
// Démarrez la session si ce n'est pas déjà fait
session_start();

// Déconnectez l'utilisateur en supprimant toutes les données de session
session_unset();
session_destroy();

// Redirigez l'utilisateur vers la page de connexion
header("Location: register_doctor.php");
exit(); 
?>
