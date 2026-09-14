
        document.addEventListener('DOMContentLoaded', function () {
            const apiKey = '4ea50b45d21ada72083adff687e91dce';

            const searchForm = document.getElementById('movie-search-form');
            const searchInput = document.getElementById('movie-search-input');
            if (searchForm && searchInput) {
                $('#movie-search-input').autocomplete({
                    source: function (request, response) {
                        fetch(`https://api.themoviedb.org/3/search/movie?api_key=${apiKey}&language=es&query=${encodeURIComponent(request.term)}`)
                            .then(result => result.json())
                            .then(data => response((data.results || []).slice(0, 4).map(movie => ({
                                label: movie.title,
                                value: movie.title,
                                id: movie.id
                            })))).catch(() => response([]));
                    },
                    minLength: 2,
                    select: function (event, ui) {
                        window.location.href = `detalle pelicula.php?id=${ui.item.id}`;
                    }
                });

                searchForm.addEventListener('submit', function (event) {
                    event.preventDefault();
                    const movieName = searchInput.value.trim();
                    if (!movieName) {
                        searchInput.focus();
                        return;
                    }

                    fetch(`https://api.themoviedb.org/3/search/movie?api_key=${apiKey}&language=es&query=${encodeURIComponent(movieName)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.results && data.results.length > 0) {
                                window.location.href = `detalle pelicula.php?id=${data.results[0].id}`;
                            } else {
                                alert('No se encontraron películas con ese nombre.');
                            }
                        })
                        .catch(() => alert('No se pudo realizar la búsqueda.'));
                });
            }
    
            // Obtener el ID de la película de la URL
            const params = new URLSearchParams(window.location.search);
            const movieId = params.get('id');
    
            // Verificar si el ID está presente en la URL
            if (!movieId) {
                console.error('ID de película no proporcionado en la URL.');
                return;
            }
    
            const apiUrl = `https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=es`;
    
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const posterPath = data.poster_path;
                    const posterUrl = `https://image.tmdb.org/t/p/w500${posterPath}`;
    
                    document.getElementById('movie-poster').src = posterUrl;
                    document.getElementById('movie-title').textContent = data.title;
                    document.getElementById('movie-overview').textContent = data.overview;
    
                    // Modificar el enlace de votar para incluir el ID de la película
                    const voteButton = document.getElementById('vote-button');
                    voteButton.href = `rating.php?pelicula_id=${movieId}`;
                })
                .catch(error => console.error('Error al obtener detalles de la película:', error));
    
                fetch(`https://api.themoviedb.org/3/movie/${movieId}/credits?api_key=${apiKey}&language=es`)
                .then(response => response.json())
                .then(data => {
                    const actorsListContent = document.getElementById('actors-list-content');
                
                    // Recorre la lista de actores y agrega sus nombres al contenido (solo los primeros 10)
                    data.cast.slice(0, 10).forEach(actor => {
                        actorsListContent.innerHTML += `<span>${actor.name}, </span>`;
                    });
                })
                
                .catch(error => console.error('Error al obtener actores de la película:', error));
        });
        /*document.addEventListener('DOMContentLoaded', function () {
            const apiKey = '4ea50b45d21ada72083adff687e91dce';

            // Obtener el ID de la película de la URL
            const params = new URLSearchParams(window.location.search);
            const movieId = params.get('id');

            // Verificar si el ID está presente en la URL
            if (!movieId) {
                console.error('ID de película no proporcionado en la URL.');
                return;
            }

            const apiUrl = `https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=es`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Tu código para obtener detalles de la película
                })
                .catch(error => console.error('Error al obtener detalles de la película:', error));

            fetch(`https://api.themoviedb.org/3/movie/${movieId}/credits?api_key=${apiKey}&language=es`)
                .then(response => response.json())
                .then(data => {
                    // Tu código para obtener actores de la película
                })
                .catch(error => console.error('Error al obtener actores de la película:', error));

            // Función para agregar comentarios falsos al contenedor
            function addFakeComments() {
                const commentsContainer = document.getElementById('comments-container');

                // Array de comentarios falsos
                const fakeComments = [
                { username: 'Usuario1', score: 8, comment: 'Buena película' },
                    { username: 'Usuario2', score: 6, comment: 'Interesante, pero podría mejorar' },
                    // Agrega más comentarios según sea necesario
                ];

                // Agregar cada comentario al contenedor
                fakeComments.forEach(comment => {
                    const commentElement = document.createElement('div');
                    commentElement.innerHTML = `
                        <div class="fake-comment">
                            <img src="frontend/image/perfil/DefaultFPerfil.jpg" alt="Foto de perfil">
                            <p><strong>${comment.username}</strong> - Puntuación: ${comment.score}</p>
                            <p>${comment.comment}</p>
                        </div>
                    `;
                    commentsContainer.appendChild(commentElement);
                });
            }

            // Llama a la función para agregar comentarios falsos
            addFakeComments();
        });*/