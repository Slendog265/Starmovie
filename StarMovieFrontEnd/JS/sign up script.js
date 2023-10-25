// Función para obtener la ubicación del usuario
function getUserLocation() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                // Obtener las coordenadas de latitud y longitud
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Utiliza un servicio de geocodificación inversa para obtener la dirección
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                    .then(response => response.json())
                    .then(data => {
                        const country = data.address.country;
                        const city = data.address.city;
                        
                        document.getElementById('user-country').textContent = country;
                        document.getElementById('user-city').textContent = city;
                        document.getElementById('pais').value = country;
                        document.getElementById('ciudad').value = city;
                    })
                    .catch(error => {
                        console.error('Error al obtener la ubicación del usuario:', error);
                    });
            },
            function (error) {
                if (error.code === error.PERMISSION_DENIED) {
                    // El usuario ha rechazado la solicitud de geolocalización
                    document.getElementById('user-country').textContent = "No revelado";
                    document.getElementById('user-city').textContent = "No revelado";
                    document.getElementById('pais').value = "No revelado";
                    document.getElementById('ciudad').value = "No revelado";
                } else {
                    console.error('Error al obtener la ubicación del usuario:', error);
                }
            }
        );
    } else {
        // Si el navegador no admite geolocalización, establecer un valor predeterminado
        document.getElementById('user-country').textContent = "No revelado";
        document.getElementById('user-city').textContent = "No revelado";
        document.getElementById('pais').value = "No revelado";
        document.getElementById('ciudad').value = "No revelado";
    }
}

// Llama a la función para obtener la ubicación del usuario cuando la página se carga
window.addEventListener('load', getUserLocation);
