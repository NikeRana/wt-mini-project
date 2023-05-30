<?php
// RapidAPI configuration
$apiKey = '8c188f1148msh2ea21770af296d4p1ccebfjsn081246345a63';
$apiHost = 'online-movie-database.p.rapidapi.com';

// Fetch popular movies from RapidAPI
$endpoint = 'https://' . $apiHost . '/?type=get-popular-movies&page=1&year=2021';
$headers = [
    'X-RapidAPI-Key: ' . $apiKey,
    'X-RapidAPI-Host: ' . $apiHost
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

$movies = json_decode($response, true)['movie_results'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie Website</title>
    <style>
        .movie {
            display: inline-block;
            width: 200px;
            margin: 10px;
        }

        .movie img {
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Popular Movies</h1>
    <div class="movies">
        <?php foreach ($movies as $movie): ?>
            <div class="movie">
                <img src="<?php echo $movie['poster']; ?>" alt="<?php echo $movie['title']; ?>">
                <h3><?php echo $movie['title']; ?></h3>
                <p><?php echo $movie['overview']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
