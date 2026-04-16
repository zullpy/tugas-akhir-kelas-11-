document.addEventListener("DOMContentLoaded", function () {

    // ===== MODAL TAMBAH =====
    const modal = document.getElementById("modalBuku");
    const btn = document.getElementById("btnTambahPeminjaman");
    const closeModal = document.getElementById("closeModal");

    btn.addEventListener("click", function (e) {
        e.preventDefault();
        modal.classList.add("show");
    });

    closeModal.addEventListener("click", function () {
        modal.classList.remove("show");
    });

    window.addEventListener("click", function (e) {
        if (e.target == modal) {
            modal.classList.remove("show");
        }
    });

    // ===== DROPDOWN CARI BUKU =====
    const searchInput = document.getElementById("searchBuku");
    const list = document.getElementById("listBuku");
    const items = list.getElementsByClassName("item");
    const hiddenInput = document.getElementById("id_buku");

    searchInput.addEventListener("focus", () => {
        list.style.display = "block";
    });

    searchInput.addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        for (let i = 0; i < items.length; i++) {
            let text = items[i].innerText.toLowerCase();
            items[i].style.display = text.includes(filter) ? "" : "none";
        }
    });

    for (let item of items) {
        item.addEventListener("click", function () {
            searchInput.value = this.innerText;
            hiddenInput.value = this.getAttribute("data-id");
            list.style.display = "none";
        });
    }

    document.addEventListener("click", function (e) {
        if (!searchInput.contains(e.target) && !list.contains(e.target)) {
            list.style.display = "none";
        }
    });

    // ===== VALIDASI TANGGAL =====
    const tglPinjam = document.querySelector('input[name="tanggal_pinjam"]');
    const tglKembali = document.getElementById("tgl_kembali");

    if (tglPinjam && tglKembali) {
        tglPinjam.addEventListener("change", function () {
            let pinjam = new Date(this.value);
            let max = new Date(pinjam);
            max.setDate(max.getDate() + 7);
            tglKembali.max = max.toISOString().split('T')[0];
            tglKembali.min = this.value;
        });
    }

});