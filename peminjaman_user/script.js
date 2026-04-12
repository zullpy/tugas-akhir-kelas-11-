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

const modal = document.getElementById("modalEdit");
const close = document.getElementById("closeModal2");

document.querySelectorAll(".btnEdit").forEach(btn => {
    btn.addEventListener("click", function() {

        modal.style.display = "block";

        document.getElementById("edit_id").value = this.dataset.id;
        document.getElementById("edit_user").value = this.dataset.user;
        document.getElementById("edit_buku").value = this.dataset.buku;
        document.getElementById("edit_pinjam").value = this.dataset.pinjam;
        document.getElementById("edit_kembali").value = this.dataset.kembali;
        document.getElementById("edit_wa").value = this.dataset.wa;
    });
});

close.onclick = () => modal.style.display = "none";