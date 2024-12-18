document.addEventListener('DOMContentLoaded', function () {
    const servicesDropdown = document.getElementById('servicesDropdown')
    const servicesMenu = document.getElementById('servicesMenu')

    // Menangani klik pada menu Services
    servicesDropdown.addEventListener('click', function (e) {
        e.preventDefault() // Mencegah link default
        e.stopPropagation() // Mencegah event bubbling ke luar

        // Menambahkan atau menghapus kelas 'active' pada menu Services
        if (servicesMenu.classList.contains('active')) {
            servicesMenu.classList.remove('active')
        } else {
            servicesMenu.classList.add('active')
        }
    })

    // Menutup menu jika klik di luar
    document.addEventListener('click', function () {
        if (servicesMenu.classList.contains('active')) {
            servicesMenu.classList.remove('active')
        }
    })
})
