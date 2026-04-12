document.getElementById("btnFilter").addEventListener("click", function() {
    const box = document.getElementById("filterBox");
    box.style.display = (box.style.display === "block") ? "none" : "block";
});

document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("modalBuku");
    const btn = document.getElementById("btnTambahBuku");
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

function closeFilterBox() {
    const box = document.getElementById("filterBox");
    box.style.display = "none";
}

function openEditModal(id, judul, penulis, penerbit, tahun, jenis, stok) {
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_judul").value = judul;
    document.getElementById("edit_penulis").value = penulis;
    document.getElementById("edit_penerbit").value = penerbit;
    document.getElementById("edit_tahun").value = tahun;
    document.querySelector("#edit_jenis select").value = jenis;
    document.getElementById("edit_stok").value = stok;
    

    document.getElementById("editModal").classList.add("show");
}

function closeEditModal() {
    document.getElementById("editModal").classList.remove("show");
}