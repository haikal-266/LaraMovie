<!-- resources/views/movies/search.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Movies</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Search Movies</h1>
        <form action="{{ route('movies.search') }}" method="GET">
            <div class="form-group">
                <input type="text" name="query" class="form-control" placeholder="Search for a movie..." value="{{ old('query', $query ?? '') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        @if(isset($movies))
            <div class="row mt-4">
                @foreach($movies as $movie)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" class="card-img-top" alt="{{ $movie['title'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie['title'] }}</h5>
                                <p class="card-text">{{ $movie['overview'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
