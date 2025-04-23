// A sample movie database
const movieDatabase = {
    "titanic": {
        title: "Titanic",
        description: "A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.",
        poster: "imgs/romance1.jpg",
    },
    "spirited_away": {
        title: "Spirited Away",
        description: "A young girl becomes trapped in a strange, magical world and must find a way to save her parents and escape.",
        poster: "imgs/children1.jpg",
    },
    "the-prestige": {
        title: "The Prestige",
        description: "Two magicians engage in a bitter rivalry, competing to create the ultimate stage illusion, with dangerous consequences.",
        poster: "imgs/suspense3.jpg",
    },
    "the_dark_knight": {
        title: "The Dark Knight",
        description: "Batman faces off against the Joker, a criminal mastermind who seeks to plunge Gotham City into anarchy.",
        poster: "imgs/action1.jpg",
    },
    "avengers_endgame": {
        title: "Avengers: Endgame",
        description: "The Avengers must assemble once again to defeat Thanos, who has wiped out half of the universe's population.",
        poster: "imgs/action2.jpg",
    },
    "spider_man": {
        title: "Spider-Man: No Way Home",
        description: "Spider-Man faces the consequences of his identity being revealed and teams up with other Spider-Men across the multiverse.",
        poster: "imgs/action3.jpg",
    },
    "dune": {
        title: "Dune",
        description: "A noble family is tasked with controlling the desert planet Arrakis, the only source of a powerful substance that can alter time and space.",
        poster: "imgs/scifi1.jpg",
    },
    "the_matrix_resurrections": {
        title: "The Matrix Resurrections",
        description: "Neo is brought back into the Matrix and must confront the new version of the world he once tried to escape.",
        poster: "imgs/scifi2.jpg",
    },
    "inception": {
        title: "Inception",
        description: "A thief who enters the dreams of others to steal secrets from their subconscious is given the task of planting an idea in the mind of a CEO.",
        poster: "imgs/sci-fi3.jpg",
    },
    "parasite": {
        title: "Parasite",
        description: "A poor family cons their way into becoming employed by a rich family, leading to unexpected consequences.",
        poster: "imgs/drama1.jpg",
    },
    "the_prestige": {
        title: "The Prestige",
        description: "Two magicians engage in a bitter rivalry, competing to create the ultimate stage illusion, with dangerous consequences.",
        poster: "imgs/suspense3.jpg",
    },
    "hidden_shadows": {
        title: "Hidden Shadows",
        description: "A mysterious town hides dark secrets only the brave dare uncover.",
        poster: "imgs/suspense4.jpg",
    },
    "night_chase": {
        title: "Night Chase",
        description: "A detective races against time to catch a runaway fugitive in the dead of night.",
        poster: "imgs/thriller4.jpg",
    },
    "lost_echoes": {
        title: "Lost Echoes",
        description: "A drama about forgotten memories and the journey to find truth.",
        poster: "imgs/drama4.jpg",
    },
    "fun_time": {
        title: "Fun Time",
        description: "An animated adventure filled with laughter, lessons, and love.",
        poster: "imgs/children4.jpg",
    },
    "love_lines": {
        title: "Love Lines",
        description: "Romance blossoms unexpectedly between two writers with rival columns.",
        poster: "imgs/romance4.jpg",
    }
};

// Function to get movie data from the URL
function getMovieDetails() {
    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get('movieId');

    if (movieId) {
        const movieKey = Object.keys(movieDatabase).find(
            key => key.toLowerCase() === movieId.toLowerCase()
        );
        const movie = movieDatabase[movieKey];

        if (movie) {
            document.getElementById('movieTitle').textContent = movie.title;
            document.getElementById('movieDescription').textContent = movie.description;
            document.getElementById('moviePoster').src = movie.poster;
            return;
        }
    }

    // Handle error if movie not found
    document.getElementById('movieTitle').textContent = "Movie not found";
    document.getElementById('movieDescription').textContent = "Sorry, this movie is not available.";
    document.getElementById('moviePoster').src = "imgs/default.jpg";  // Default image
}

// Initialize the movie details on page load
window.onload = getMovieDetails;
