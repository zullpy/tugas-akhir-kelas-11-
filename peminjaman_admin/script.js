document.addEventListener("DOMContentLoaded", function () {

    const modalTambah = document.getElementById("modalBuku");
    const btn = document.getElementById("btnTambahPeminjaman");
    const close = document.getElementById("closeModal");

    btn.addEventListener("click", function (e) {
        e.preventDefault();
        modalTambah.classList.add("show");
    });

    close.addEventListener("click", function () {
        modalTambah.classList.remove("show");
    });

    window.addEventListener("click", function (e) {
        if (e.target == modalTambah) {
            modalTambah.classList.remove("show");
        }
    });

})

const modalEdit = document.getElementById("modalEdit");
const close = document.getElementById("closeModal2");

document.querySelectorAll(".btnEdit").forEach(btn => {
    btn.addEventListener("click", function() {

        modalEdit.style.display = "flex";

        document.getElementById("edit_id").value = this.dataset.id;
        document.getElementById("edit_user").value = this.dataset.user;
        document.getElementById("edit_buku").value = this.dataset.buku;
        document.getElementById("edit_pinjam").value = this.dataset.pinjam;
        document.getElementById("edit_kembali").value = this.dataset.kembali;
        document.getElementById("edit_wa").value = this.dataset.wa;
    });
});

close.onclick = () => modalEdit.style.display = "none";

const searchInput = document.getElementById("searchBuku");
const list = document.getElementById("listBuku");
const items = list.getElementsByClassName("item");
const hiddenInput = document.getElementById("id_buku");

// munculin list saat fokus
searchInput.addEventListener("focus", () => {
    list.style.display = "block";
});

// filter search
searchInput.addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();

    for (let i = 0; i < items.length; i++) {
        let text = items[i].innerText.toLowerCase();
        items[i].style.display = text.includes(filter) ? "" : "none";
    }
});

// pilih item
for (let item of items) {
    item.addEventListener("click", function() {
        searchInput.value = this.innerText;
        hiddenInput.value = this.getAttribute("data-id");
        list.style.display = "none";
    });
}

// klik luar nutup dropdown
document.addEventListener("click", function(e) {
    if (!searchInput.contains(e.target) && !list.contains(e.target)) {
        list.style.display = "none";
    }
});

const searchUser = document.getElementById("searchUser");
const listUser = document.getElementById("listUser");
const itemsUser = listUser.getElementsByClassName("item-user");
const hiddenUser = document.getElementById("id_user");

// tampilkan dropdown
searchUser.addEventListener("focus", () => {
    listUser.style.display = "block";
});

// filter
searchUser.addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();

    for (let i = 0; i < itemsUser.length; i++) {
        let text = itemsUser[i].innerText.toLowerCase();
        itemsUser[i].style.display = text.includes(filter) ? "" : "none";
    }
});

// pilih user
for (let item of itemsUser) {
    item.addEventListener("click", function() {
        searchUser.value = this.innerText;
        hiddenUser.value = this.getAttribute("data-id");
        listUser.style.display = "none";
    });
}

const tglPinjam = document.querySelector('input[name="tanggal_pinjam"]');
const tglKembali = document.getElementById("tgl_kembali");

tglPinjam.addEventListener("change", function() {
    let pinjam = new Date(this.value);

    // max 7 hari
    let max = new Date(pinjam);
    max.setDate(max.getDate() + 7);

    // format ke yyyy-mm-dd
    let maxFormat = max.toISOString().split('T')[0];

    tglKembali.max = maxFormat;
    tglKembali.min = this.value; // ga boleh sebelum pinjam
});