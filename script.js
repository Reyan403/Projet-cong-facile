// burger menu
function toggleMenu() {
    const menu = document.getElementById("menu");
    menu.classList.toggle("show");
}

// mdp caché ou non
function togglePassword(inputId, eyeId) {
    const passwordInput = document.getElementById(inputId);
    const toggleEye = document.getElementById(eyeId);

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
        let start = new Date(dateDebut);
        let end = new Date(dateFin);
        end.setHours(0, 0, 0, 0);
        start.setHours(0, 0, 0, 0);

        if (end < start) {
            joursDemandes.value = 0;
            return;
        }

        let joursOuvres = 0;

        // Liste des jours fériés en France (exemple pour 2025, à ajuster dynamiquement si nécessaire)
        const joursFeries = [
            "2025-01-01",
            "2025-04-21",
            "2025-05-01",
            "2025-05-08",
            "2025-05-29",
            "2025-06-09",
            "2025-07-14",
            "2025-08-15",
            "2025-11-01",
            "2025-11-11",
            "2025-12-25"
        ];

        // Parcours des jours entre start et end
        let current = new Date(start);
        while (current <= end) {
            const jour = current.getDay(); // 0 = dimanche, 6 = samedi
            const formattedDate = current.toISOString().split('T')[0];

            if (jour !== 0 && jour !== 6 && !joursFeries.includes(formattedDate)) {
                joursOuvres++;
            }

            current.setDate(current.getDate() + 1);
        }

        joursDemandes.value = joursOuvres;
    } else {
        joursDemandes.value = '';
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

//Bouton switch
const switchBtn = document.getElementById('switchBtn');
    switchBtn.addEventListener('click', () => {
        switchBtn.classList.toggle('active');
});


const switchBtn2 = document.getElementById('switchBtn2');
    switchBtn2.addEventListener('click', () => {
        switchBtn2.classList.toggle('active');
});

