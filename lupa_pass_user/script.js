document.querySelectorAll('.link-slide').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();

        const href = this.href;

        // reset dulu
        document.body.classList.remove('fade-out-up', 'fade-out-right');

        // tentukan arah
        if (this.classList.contains('slide-up')) {
            document.body.classList.add('fade-out-up');
        } else if (this.classList.contains('slide-right')) {
            document.body.classList.add('fade-out-right');
        }

        setTimeout(() => {
            window.location.href = href;
        }, 300);
    });
});