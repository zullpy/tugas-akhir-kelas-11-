document.querySelectorAll('.link-slide').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();

        const href = this.querySelector('a').href;

        // reset dulu
        document.body.classList.remove('fade-out-up', 'fade-out-down');

        // tentukan arah
        if (this.classList.contains('slide-up')) {
            document.body.classList.add('fade-out-up');
        } else if (this.classList.contains('slide-down')) {
            document.body.classList.add('fade-out-down');
        }

        setTimeout(() => {
            window.location.href = href;
        }, 300);
    });
});

// Toggle password visibility   
const togglePassword = document.querySelector('#togglePassword');
const passwordField = document.querySelector('input[name="konfirmasi"]');

togglePassword.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('ph-eye-slash');
});

const togglePasswordBaru = document.querySelector('#togglePasswordBaru');
const passwordBaruField = document.querySelector('input[name="password_baru"]');

togglePasswordBaru.addEventListener('click', function () {
    const type = passwordBaruField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordBaruField.setAttribute('type', type);
    this.classList.toggle('ph-eye-slash');
});