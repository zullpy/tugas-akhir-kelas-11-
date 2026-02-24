document.querySelectorAll('.link-slide').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();

        const href = this.href;

        // reset dulu
        document.body.classList.remove('fade-out-left', 'fade-out-right');

        // tentukan arah
        if (this.classList.contains('slide-left')) {
            document.body.classList.add('fade-out-left');
        } else if (this.classList.contains('slide-right')) {
            document.body.classList.add('fade-out-right');
        }

        setTimeout(() => {
            window.location.href = href;
        }, 300);
    });
});


window.addEventListener('pageshow', () => {
    document.body.classList.remove('fade-out-left', 'fade-out-right');
});
