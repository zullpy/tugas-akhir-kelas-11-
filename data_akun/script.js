const modal = document.getElementById("modalUser");
const btn = document.getElementById("btnTambah");
const close = document.getElementById("closeModal");

// buka modal
btn.addEventListener("click", function () {
    modal.style.display = "flex";
});

// tutup modal
close.addEventListener("click", function () {
    modal.style.display = "none";
});

// klik luar modal = tutup
window.addEventListener("click", function (e) {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});

const modal2 = document.getElementById("modalAdmin");
const btn2 = document.getElementById("btnTambah2");
const close2 = document.getElementById("closeModal2");

// buka modal
btn2.addEventListener("click", function () {
    modal2.style.display = "flex";
});

// tutup modal
close2.addEventListener("click", function () {
    modal2.style.display = "none";
});

// klik luar modal = tutup
window.addEventListener("click", function (e) {
    if (e.target === modal2) {
        modal2.style.display = "none";
    }
});


// Toggle Password
const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("input-password");

togglePassword.addEventListener("click", () => {
    const isPassword = passwordInput.type === "password";

    passwordInput.type = isPassword ? "text" : "password";

    togglePassword.classList.toggle("ph-eye");
    togglePassword.classList.toggle("ph-eye-slash");
});