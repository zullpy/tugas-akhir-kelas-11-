document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("modalAdmin");
    const btn = document.getElementById("btnTambahAdmin");
    const close = document.getElementById("closeModal");

    btn.addEventListener("click", function (e) {
        e.preventDefault();
        modal.style.display = "block";
    });

    close.addEventListener("click", function () {
        modal.style.display = "none";
    });

    window.addEventListener("click", function (e) {
        if (e.target == modal) {
            modal.style.display = "none";
        }
    });

})

// Toggle Password
const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("input-password");

togglePassword.addEventListener("click", () => {
    const isPassword = passwordInput.type === "password";

    passwordInput.type = isPassword ? "text" : "password";

    togglePassword.classList.toggle("ph-eye");
    togglePassword.classList.toggle("ph-eye-slash");
});