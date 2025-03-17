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
