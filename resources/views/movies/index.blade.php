<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        :root {
            --light-text: #2c0d54;
            --light-nav: #5e35b1;
            --light-card: #f3e5ff;
            --dark-bg: #1a1a2e;
            --dark-text: #e0e0e0;
            --dark-nav: #16213e;
            --dark-card: #0f3460;
        }
        body {
            transition: background-image 0.3s, color 0.3s;
            background-image: linear-gradient(135deg, #9c27b0, #673ab7);
            background-attachment: fixed;
            color: var(--light-text);
        }
        body.dark-mode {
            background-image: linear-gradient(135deg, #1a1a2e, #16213e);
            color: var(--dark-text);
        }
        .navbar {
            background-color: var(--light-nav) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .dark-mode .navbar {
            background-color: var(--dark-nav) !important;
        }
        .navbar-brand, .nav-link, .navbar-nav .nav-link.active {
            color: #ffffff !important;
        }
        .card {
            background-color: var(--light-card);
            color: var(--light-text);
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
        }
        .dark-mode .card {
            background-color: var(--dark-card);
            color: var(--dark-text);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,.15);
        }
        .card-img-top {
            height: 300px;
            object-fit: cover;
        }
        .card-text {
            height: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .btn-outline-light {
            color: #ffffff;
            border-color: #ffffff;
        }
        .dark-mode .btn-outline-light {
            color: #bb86fc;
            border-color: #bb86fc;
        }
        .form-control {
            background-color: rgba(255,255,255,0.2);
            border: none;
            color: #ffffff;
        }
        .form-control::placeholder {
            color: rgba(255,255,255,0.7);
        }
        .dark-mode .form-control {
            background-color: rgba(255,255,255,0.1);
            color: var(--dark-text);
        }
        .dark-mode .form-control::placeholder {
            color: rgba(255,255,255,0.5);
        }
        .badge {
            font-size: 0.9em;
            padding: 0.5em 0.7em;
        }
        .badge.bg-primary {
            background-color: #4a148c !important;
            color: #ffffff;
        }
        .dark-mode .badge.bg-primary {
            background-color: #bb86fc !important;
            color: #000000;
        }
        .dropdown-menu {
            background-color: var(--light-nav);
        }
        .dark-mode .dropdown-menu {
            background-color: var(--dark-nav);
        }
        .dropdown-item {
            color: #ffffff;
        }
        .dropdown-item:hover {
            background-color: rgba(255,255,255,0.1);
        }
        .text-muted {
            color: #4a0e78 !important;
        }
        .dark-mode .text-muted {
            color: #a0a0a0 !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-film me-2"></i>MovieDB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-home me-1"></i>Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="genreDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-theater-masks me-1"></i>Genres
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-fist-raised me-2"></i>Action</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-laugh me-2"></i>Comedy</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-heart-broken me-2"></i>Drama</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-rocket me-2"></i>Sci-Fi</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex me-3" action="{{ route('movies.index') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" name="query" placeholder="Search movies..." aria-label="Search" value="{{ $query ?? '' }}">
                        <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <button id="darkModeToggle" class="btn btn-outline-light">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="my-4 text-center text-light">Popular Movies</h1>

        @if(isset($query) && empty($movies))
            <div class="alert alert-info" role="alert">
                Ups, nggak ada film yang cocok nih dengan "{{ $query }}". Coba keyword lain yuk!
            </div>
        @endif
        
        <div class="row">
            @foreach($movies as $movie)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" class="card-img-top" alt="{{ $movie['title'] }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $movie['title'] }}</h5>
                            <p class="card-text flex-grow-1">{{ $movie['overview'] }}</p>
                            <div class="mt-auto">
                                <span class="badge bg-primary me-2">
                                    <i class="fas fa-star me-1"></i>{{ $movie['vote_average'] }}
                                </span>
                                <small class="text-muted">{{ $movie['release_date'] }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');
        const body = document.body;

        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            }
        });
    </script>
</body>
</html>