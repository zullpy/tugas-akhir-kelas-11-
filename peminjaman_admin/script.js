document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("modalBuku");
    const btn = document.getElementById("btnTambahPeminjaman");
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