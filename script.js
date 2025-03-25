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

