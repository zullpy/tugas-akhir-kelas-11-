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
const closeModal2 = document.getElementById("closeModal2");

// ambil semua tombol edit
document.querySelectorAll(".btn-edit").forEach(btn => {
    btn.addEventListener("click", function () {

        // buka modal
        modalEdit.classList.add("show");

        // ambil data dari tombol
        document.getElementById("edit_id").value = this.dataset.id;
        document.getElementById("edit_user").value = this.dataset.id_user;
        document.getElementById("edit_buku").value = this.dataset.id_buku;
        document.getElementById("edit_pinjam").value = this.dataset.pinjam;
        document.getElementById("edit_kembali").value = this.dataset.kembali;
        document.getElementById("edit_wa").value = this.dataset.wa;
    });
});

// tombol close
closeModal2.onclick = function () {
    modalEdit.classList.remove("show");
};

// klik luar modal
window.onclick = function (event) {
    if (event.target == modalEdit) {
        modalEdit.classList.remove("show");
    }
};



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

// validasi nomor WA
const waInput = document.getElementById("no_wa");

waInput.addEventListener("input", function () {
    let value = this.value;

    // hapus selain angka
    this.value = value.replace(/[^0-9]/g, "");
});

document.querySelector("form").addEventListener("submit", function(e){
    let wa = document.getElementById("no_wa").value;

    // regex nomor indo
    let regex = /^(08|628)[0-9]{8,11}$/;

    if(!regex.test(wa)){
        alert("Nomor WhatsApp tidak valid!");
        e.preventDefault(); // stop submit
    }
});