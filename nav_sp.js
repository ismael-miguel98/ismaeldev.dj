// Sélectionnez tous les liens dans la barre de navigation
var navLinks = document.querySelectorAll("header nav ul li a");

// Parcourez tous les liens et ajoutez un gestionnaire d'événements pour le clic
navLinks.forEach(function(link) {
    link.addEventListener("click", function(event) {
        // Empêche le comportement par défaut du lien
        event.preventDefault();

        // Supprimez la classe active de tous les liens
        navLinks.forEach(function(link) {
            link.classList.remove("active");
        });

        // Ajoutez la classe active au lien sur lequel vous avez cliqué
        this.classList.add("active");

        // Mettez le focus sur le lien sur lequel vous avez cliqué
        this.focus();
    });
});
