// ===== Hamburger menu (JS-driven, menggantikan checkbox hack) =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// ===== Counter Tabel =====
function updateTableCounter() {
    const counter = document.getElementById("table-counter");
    const table = document.querySelector(".table-responsive table");
    if (!counter || !table) return;

    const totalRows = table.querySelectorAll("tbody tr").length;
    const visibleRows = Array.from(table.querySelectorAll("tbody tr")).filter(row => row.style.display !== "none").length;
    counter.textContent = `Menampilkan ${visibleRows} dari ${totalRows} data`;
}

// ===== Konfirmasi hapus (front-end only, belum ke server) =====
// Memakai event delegation di document karena baris tabel sekarang
// dirender dinamis via fetch (lihat buku.js/anggota.js) sehingga
// tombol .btn-hapus belum tentu ada saat DOMContentLoaded.
function initHapusConfirm() {
    document.addEventListener("click", function (e) {
        console.log("Elemen yang diklik:", e.target);
        const btn = e.target.closest(".btn-hapus");
        if (!btn) return;
        
        const row = btn.closest("tr");
        const nama = row ? row.querySelector("td")?.textContent : "data ini";
        const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
        if (yakin && row) {
            row.remove();
            updateTableCounter();
        }
    });
}

// ===== Filter/pencarian tabel real-time =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const td = row.querySelector("td");
            const teks = td ? td.textContent.toLowerCase() : "";
            row.style.display = teks.includes(keyword) ? "" : "none";
        });
        updateTableCounter();
    });
}

// ===== Validasi form (client-side) =====
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    // Filter real-time untuk ISBN: hanya izinkan angka dan tanda hubung diketik
    const isbnInput = form.querySelector("[name='isbn']");
    if (isbnInput) {
        isbnInput.addEventListener("input", function() {
            this.value = this.value.replace(/[^0-9-]/g, '');
        });
    }

    form.addEventListener("submit", function (e) {
        let valid = true;

        // Refactor validasi field wajib menggunakan forEach (Ide Latihan Tambahan #5)
        const requiredFields = ['judul', 'nama', 'pengarang', 'email', 'telepon', 'tahun'];
        requiredFields.forEach(function (name) {
            const field = form.querySelector(`[name='${name}']`);
            if (field) {
                if (field.value.trim() === "") {
                    tampilkanError(field, "Field ini wajib diisi.");
                    valid = false;
                } else {
                    hapusError(field);
                }
            }
        });

        // Validasi khusus Tahun
        const tahun = form.querySelector("[name='tahun']");
        if (tahun && tahun.value.trim() !== "") {
            const nilai = parseInt(tahun.value, 10);
            if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {
                tampilkanError(tahun, "Tahun harus di antara 1900-2026.");
                valid = false;
            } else {
                // Hapus error jika lolos
                // Namun pastikan kita tidak menghapus error required jika belum diisi,
                // karena itu sudah ditangani di bagian requiredFields
                hapusError(tahun);
            }
        }

        // Validasi khusus Stok
        const stok = form.querySelector("[name='stok']");
        if (stok && stok.value.trim() !== "") {
            const nilai = parseInt(stok.value, 10);
            if (isNaN(nilai) || nilai < 0) {
                tampilkanError(stok, "Stok tidak boleh negatif.");
                valid = false;
            } else {
                hapusError(stok);
            }
        }

        // Validasi khusus ISBN (Ide Latihan Tambahan #1)
        const isbn = form.querySelector("[name='isbn']");
        if (isbn && isbn.value.trim() !== "") {
            const value = isbn.value.trim();
            // Hanya angka dan tanda hubung
            if (!/^[0-9-]+$/.test(value)) {
                tampilkanError(isbn, "ISBN hanya boleh berisi angka dan tanda hubung.");
                valid = false;
            } else {
                hapusError(isbn);
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    updateTableCounter();
    initValidasiForm();
});
