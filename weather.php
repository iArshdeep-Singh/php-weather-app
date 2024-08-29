<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 10px;
            text-align: center;
            box-sizing: border-box;
        }
        h1, h2 {
            color: #333;
            margin: 0;
            padding: 10px;
        }
        p {
            font-size: 1.2em;
            color: #555;
            margin: 10px 0;
        }
        .weather-info {
            margin: 20px 0;
        }
        .weather-icon {
            width: 80px;
            height: 80px;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            font-size: 1em;
        }
        a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
                padding: 20px;
            }
            h1, h2 {
                font-size: 1.5em;
            }
            p {
                font-size: 1.1em;
            }
            .weather-icon {
                width: 60px;
                height: 60px;
            }
        }

        @media (max-width: 480px) {
            h1, h2 {
                font-size: 1.2em;
            }
            p {
                font-size: 1em;
            }
            .weather-icon {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <div>
        <h1>Weather Information</h1>
        <?php
            if (isset($_GET['city'])) {
                $city = htmlspecialchars($_GET['city']);
                $apiKey = '9d7208e2e850eda8f60d01bda3cf7406'; // Your provided API key
                $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&appid=" . $apiKey . "&units=metric";

                $weatherData = file_get_contents($apiUrl);
                $weatherArray = json_decode($weatherData, true);

                if ($weatherArray['cod'] === 200) { // 200 is the code for a successful response
                    $temperature = $weatherArray['main']['temp'];
                    $humidity = $weatherArray['main']['humidity'];
                    $windSpeed = $weatherArray['wind']['speed'];
                    $weatherDescription = ucfirst($weatherArray['weather'][0]['description']);
                    $icon = $weatherArray['weather'][0]['icon'];
                    $iconUrl = "http://openweathermap.org/img/wn/" . $icon . "@2x.png";

                    echo "<h2>Weather for <span style='color:royalblue;'>" . ucfirst($city) . "</span></h2>";
                    echo "<div class='weather-info'>";
                    echo "<p><img class='weather-icon' src='" . $iconUrl . "' alt='Weather Icon'></p>";
                    echo "<p><span style='color:crimson;'>Temperature:</span> " . $temperature . "°C</p>";
                    echo "<p><span style='color:crimson;'>Condition:</span> " . $weatherDescription . "</p>";
                    echo "<p><span style='color:crimson;'>Humidity:</span> " . $humidity . "%</p>";
                    echo "<p><span style='color:crimson;'>Wind Speed:</span> " . $windSpeed . " m/s</p>";
                    echo "</div>";
                } else {
                    echo "<p>City not found. Please try again.</p>";
                }
            } else {
                echo "<p>No city entered. Please go back and try again.</p>";
            }
        ?>
        <p><a href="index.html">Go Back</a></p>
    </div>
</body>
</html>
