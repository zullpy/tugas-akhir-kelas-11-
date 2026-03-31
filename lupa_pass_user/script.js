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