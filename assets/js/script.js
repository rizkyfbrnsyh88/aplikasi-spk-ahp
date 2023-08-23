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

function myFunction(noDropdown) {
    const dropdown = document.getElementById("dropdown-"+noDropdown);
    dropdown.classList.toggle("show");
  }
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-menu");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }

// const itemMenus = document.querySelectorAll('.item-menu');
// const dropdownMenus = document.querySelectorAll('.dropdown-menu');

// itemMenus.forEach((itemMenu, index) => {
//   itemMenu.addEventListener('click', () => {
//     dropdownMenus[index].classList.toggle('show');
//   });
// });

    
