// burger menu
function toggleMenu() {
    var menu = document.getElementById("menu");
    menu.classList.toggle("show");
}

// mdp caché ou non
function togglePassword() {
    var passwordInput = document.getElementById("password");
    var toggleEye = document.getElementById("toggleEye");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleEye.src = "./PNG/oeil.png"; 
    } else {
        passwordInput.type = "password";
        toggleEye.src = "./PNG/les-yeux-croises.png"; 
    }
}

// ça sert à ce que je vois le nom du fichier déposé à l'intérieur du champ
function updateFileName(input) {
    let fileName = input.files.length > 0 ? input.files[0].name : "Sélectionner un fichier";
    document.getElementById("file-name").textContent = fileName;
}

// ça sert à ce que l'utilisateur puisse voir le nombre de jours demandés
function calculerJours() {
    const dateDebut = document.getElementById('date-debut').value;
    const dateFin = document.getElementById('date-fin').value;
    const joursDemandes = document.getElementById('jours-demandes');

    if (dateDebut && dateFin) {
        const date1 = new Date(dateDebut);
        const date2 = new Date(dateFin);
        const diffTime = date2 - date1;
        let diffDays = diffTime / (1000 * 3600 * 24) + 1; // Ajoute 1 pour inclure le jour de début

        if (diffDays >= 0) {
            joursDemandes.value = Math.floor(diffDays); // Arrondi à l'inférieur
        } else {
            alert("La date de fin doit être supérieure ou égale à la date de début.");
            joursDemandes.value = ''; // Réinitialise si les dates ne sont pas valides
        }
    } else {
        joursDemandes.value = ''; // Si une date manque, réinitialise le champ
    }
}

