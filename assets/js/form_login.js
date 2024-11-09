function validateForm() {
    let email = document.getElementById("email_login").value;
    let senha = document.getElementById("senha_login").value;

    if (!email || !senha) { 
        alert("Por favor, preencha todos os campos.");
        return false;
    }
    return true;  
}