// burger menu
function toggleMenu() {
    const menu = document.getElementById("menu");
    menu.classList.toggle("show");
}

// mdp caché ou non
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const toggleEye = document.getElementById("toggleEye");

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
        }
    } else {
        joursDemandes.value = ''; // Si une date manque, réinitialise le champ
    }
}

// Fonction de recherche dans le tableau
function searchTable() {
    let input, filter, table, tr, td, i, txtValue;
    input = document.querySelectorAll('input[type="search"]');
    table = document.getElementById("requestsTable");
    tr = table.getElementsByTagName("tr");
    
    for (let i = 1; i < tr.length; i++) {
        let row = tr[i];
        let showRow = true;
        
        for (let j = 0; j < input.length; j++) {
            filter = input[j].value.toUpperCase();
            td = row.getElementsByTagName("td")[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) === -1) {
                    showRow = false;
                    break;
                }
            }
        }
        
        if (showRow) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    }
}

// Attache les fonctions de tri et de recherche à des événements
window.onload = function() {
    document.querySelectorAll('.arrow-top').forEach(function(arrow) {
        arrow.addEventListener('click', function() {
            const columnIndex = arrow.parentNode.parentNode.cellIndex;
            sortTable(columnIndex, true); // Tri ascendant
        });
    });

    document.querySelectorAll('.arrow-bottom').forEach(function(arrow) {
        arrow.addEventListener('click', function() {
            const columnIndex = arrow.parentNode.parentNode.cellIndex;
            sortTable(columnIndex, false); // Tri descendant
        });
    });

    document.querySelectorAll('input[type="search"]').forEach(function(input) {
        input.addEventListener('keyup', function() {
            searchTable();
        });
    });
};

// Fonction de tri
function sortTable(n, ascending = true) {
let table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
table = document.getElementById("requestsTable");
switching = true;
dir = ascending ? "asc" : "desc";  // Si "asc", on trie dans l'ordre croissant, sinon décroissant

while (switching) {
switching = false;
rows = table.rows;

for (i = 1; i < (rows.length - 1); i++) {
    shouldSwitch = false;
    x = rows[i].getElementsByTagName("TD")[n];
    y = rows[i + 1].getElementsByTagName("TD")[n];

    if (dir == "asc") {
        if (x.innerHTML.trim() > y.innerHTML.trim()) {  // Tri croissant
            shouldSwitch = true;
            break;
        }
    } else if (dir == "desc") {
        if (x.innerHTML.trim() < y.innerHTML.trim()) {  // Tri décroissant
            shouldSwitch = true;
            break;
        }
    }
}

if (shouldSwitch) {
    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
    switching = true;
    switchcount++;
} else {
    if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
    }
}
}

let arrowTop = table.rows[0].cells[n].getElementsByClassName("arrow-top")[0];
let arrowBottom = table.rows[0].cells[n].getElementsByClassName("arrow-bottom")[0];

// Réexécuter la fonction de recherche après le tri
searchTable();
}


//Validation
document.getElementById("validate-request").addEventListener("click", function() {
    var demandeId = this.getAttribute("data-id"); // Récupère l'ID de la demande depuis l'attribut data-id

    // Afficher un message de confirmation
    document.getElementById("confirmation-message").style.display = "block";
    
    // Effectuer une requête AJAX pour valider la demande côté serveur
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "traitement.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onload = function() {
        if (xhr.status == 200) {
            // Traitement effectué avec succès côté serveur
            console.log("Demande validée");
        }
    };
    
    // Envoie l'ID de la demande au fichier PHP
    xhr.send("action=valider_demande&id_demande=" + demandeId);
});
