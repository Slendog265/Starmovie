$(document).ready(function () {
    // Obtener referencias a elementos HTML que vamos a utilizar
    const searchButton = $('#search-button');

    // Agregar un evento clic al botón de búsqueda usando jQuery
    searchButton.click(() => {
        searchMovie();
    });

    // Inicializar el autocompletado en el campo de búsqueda
    $('#search-input').autocomplete({
        source: function (request, response) {
            searchMovieAsync(request.term, response);
        },
        minLength: 2, // Número mínimo de caracteres antes de realizar la búsqueda
        select: function (event, ui) {
            // Redirigir a la página de detalles al seleccionar una película
            window.location.href = 'detalle pelicula.php?id=' + ui.item.id;
        }
    });

    function searchMovie() {
        var apiKey = '4ea50b45d21ada72083adff687e91dce';
        var movieName = $('#search-input').val();

        // Validar que el campo de búsqueda no esté vacío
        if (movieName.trim() === '') {
            $('#searchResultsContainer').html('<p class="col-12">Por favor, ingrese el nombre de la película.</p>');
            return;
        }

        var apiUrl = 'https://api.themoviedb.org/3/search/movie?api_key=' + apiKey + '&query=' + encodeURIComponent(movieName);

        $.ajax({
            url: apiUrl,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                displayMovieResults(data.results);
            },
            error: function (error) {
                console.log('Error al realizar la solicitud: ', error);
            }
        });
    }

    function displayMovieResults(movieResults) {
        var resultsContainer = $('#searchResultsContainer');
        resultsContainer.empty();

        if (movieResults.length > 0) {
            for (var i = 0; i < movieResults.length; i++) {
                var movieTitle = movieResults[i].title;
                var moviePoster = 'https://image.tmdb.org/t/p/w500' + movieResults[i].poster_path;
                var movieDirector = movieResults[i].director ? 'Director: ' + movieResults[i].director : 'Director no disponible';
                //var movieScore = movieResults[i].vote_average ? 'Puntuación: <span class="puntuacion">' + movieResults[i].vote_average + '</span>' : 'Puntuación no disponible';

                var movieElement = $('<div class="col-md-3 mb-4 movie-details">' +
                    '<div class="movie-card" data-id="' + movieResults[i].id + '">' +
                    '<img src="' + moviePoster + '" class="img-fluid" alt="' + movieTitle + '">' +
                    '<h2>' + movieTitle + '</h2>' +
                    '<p>' + movieDirector + '</p>' +
                    //'<p>' + movieScore + '</p>' +
                    '</div>' +
                    '</div>');

                resultsContainer.append(movieElement);
            }

            // Agrega el evento de clic para redirigir a la página de detalles
            $('.movie-details').click(function () {
                var movieId = $(this).find('.movie-card').data('id');
                window.location.href = 'detalle pelicula.php?id=' + movieId;
            });
        } else {
            resultsContainer.html('<p class="col-12">No se encontraron resultados para la película buscada.</p>');
        }
    }

    function searchMovieAsync(movieName, response) {
        var apiKey = '4ea50b45d21ada72083adff687e91dce';
        var apiUrl = 'https://api.themoviedb.org/3/search/movie?api_key=' + apiKey + '&query=' + encodeURIComponent(movieName);

        $.ajax({
            url: apiUrl,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Limitar a 4 resultados
                var slicedResults = data.results.slice(0, 4);

                response($.map(slicedResults, function (item) {
                    return {
                        label: item.title,
                        value: item.title,
                        id: item.id
                    };
                }));
            },
            error: function (error) {
                console.log('Error al realizar la solicitud: ', error);
            }
        });
    }
});
