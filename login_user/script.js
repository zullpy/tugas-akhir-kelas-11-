document.querySelectorAll('.link-slide').forEach(link => {
  link.addEventListener('click', function(e) {
    e.preventDefault();
    let href = this.href;

    document.body.classList.add('fade-out');

    setTimeout(() => {
      window.location.href = href;
    }, 300);
  });
});

window.addEventListener('pageshow', () => {
    document.body.classList.remove('fade-out-left', 'fade-out-right');
});