document.querySelectorAll('.link-slide').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();

        const href = this.href;

        // reset dulu
        document.body.classList.remove('fade-out-down', 'fade-out-up');

        // tentukan arah
        if (this.classList.contains('slide-down')) {
            document.body.classList.add('fade-out-down');
        } else if (this.classList.contains('slide-up')) {
            document.body.classList.add('fade-out-up');
        }

        setTimeout(() => {
            window.location.href = href;
        }, 300);
    });
});


window.addEventListener('pageshow', () => {
    document.body.classList.remove('fade-out-left', 'fade-out-right');
});

const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("input-password");

togglePassword.addEventListener("click", () => {
    const isPassword = passwordInput.type === "password";

    passwordInput.type = isPassword ? "text" : "password";

    togglePassword.classList.toggle("ph-eye");
    togglePassword.classList.toggle("ph-eye-slash");
});
