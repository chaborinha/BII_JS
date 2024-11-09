function btnDisabled() {
    const user_name = document.getElementById("nome").value;
    const user_email = document.getElementById("email").value;
    const user_password = document.getElementById("senha").value;

    if (user_name && user_email && user_password) {
        document.getElementById("btn_register").disabled = false;
    } else {
        document.getElementById("btn_register").disabled = true;
    }
}
document.getElementById("nome").addEventListener("input", btnDisabled);
document.getElementById("email").addEventListener("input", btnDisabled);
document.getElementById("senha").addEventListener("input", btnDisabled);

document.querySelector('form').addEventListener('submit', function() {
    document.getElementById("btn_register").disabled = true;
});
