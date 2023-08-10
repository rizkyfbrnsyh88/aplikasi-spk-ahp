// Ambil elemen-elemen yang diperlukan
const slides = document.getElementsByClassName("box-content");
let currentIndex = 0;

// Tampilkan slide pertama dan mulai otomatisasi
showSlide(currentIndex);
setInterval(nextSlide, 10000); // Ganti slide setiap 2 detik

function showSlide(index) {
    // Sembunyikan semua slide
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("slide");
    }

    // Tampilkan slide dengan indeks tertentu
    slides[index].classList.add("slide");
}

function nextSlide() {
    // Tambahkan 1 pada indeks saat ini untuk berpindah ke slide berikutnya
    currentIndex++;

    // Jika sudah mencapai slide terakhir, kembali ke slide pertama
    if (currentIndex === slides.length) {
        currentIndex = 0;
    }

    // Tampilkan slide berikutnya
    showSlide(currentIndex);
}

const dropdownButton = document.getElementsByClassName(".btn-dropdown");
const dropdownMenu = document.getElementsByClassName(".dropdown-menu");
  
    dropdownButton.addEventListener("click", function () {
      if (dropdownMenu.style.display === "flex") {
        dropdownMenu.style.display = "none";
      } else {
        dropdownMenu.style.display = "flex";
      }
    });
  
    // Tutup dropdown jika di luar dropdown diklik
    document.addEventListener("click", function (event) {
      if (!dropdownButton.contains(event.target)) {
        dropdownMenu.style.display = "none";
      }
    });