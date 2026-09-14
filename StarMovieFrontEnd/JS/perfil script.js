// Maneja el cambio en el input de archivo
document.getElementById("customFile2").addEventListener("change", function () {
    const fileInput = this;
    const previewImage = document.querySelector(".img-fluid");
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImage.src = e.target.result;
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
});
// Obtener referencias a elementos HTML que vamos a utilizar
const searchButton = document.getElementById("search-button");
const movieCards = document.querySelectorAll(".movie-card");

// Agregar un evento clic al botón de búsqueda
searchButton.addEventListener("click", () => {

    // Obtener el valor ingresado en el campo de búsqueda
    const searchTerm = document.getElementById("search-input").value.trim().toLowerCase();

    // Recorrer las tarjetas de película y mostrar u ocultar según la búsqueda
    movieCards.forEach(card => {
        const movieTitle = card.querySelector("h2").textContent.toLowerCase();
        if (movieTitle.includes(searchTerm)) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
});