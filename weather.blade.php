<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
    <!-- Import Google Font for Japanese-inspired style -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">


    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://i.pinimg.com/originals/76/a0/b9/76a0b92e3b694de08e9d637676478bc1.gif');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        h1 {
            font-family: 'Noto Sans JP', sans-serif;
            text-align: center;
            color: #fff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            font-size: 2.5em;
        }

        .table-container {
            position: relative;
            width: 80%;
            background-color: rgba(0, 0, 0, 0.6);
            /* Transparent dark background for overlay effect */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(139, 0, 0, 0.8), 0 0 25px rgba(139, 0, 0, 0.6);
            /* Darker glowing red effect */
            backdrop-filter: blur(5px);
            /* Slight blur for a cool effect */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #fff;
        }

        th,
        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            text-align: left;
        }

        th {
            background-color: rgba(139, 0, 0, 0.7);
            /* Darker red header */
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        tr:hover {
            background-color: rgba(139, 0, 0, 0.3);
            /* Darker red hover effect */
        }

        img.flag {
            width: 30px;
            height: auto;
            vertical-align: middle;
            margin-right: 10px;
        }

        .tooltip {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .tooltiptext {
            visibility: hidden;
            width: 200px;
            background-color: #555;
            color: #fff;
            text-align: center;
            padding: 5px;
            border-radius: 4px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            /* Adjust positioning */
            left: 50%;
            margin-left: -100px;
            /* Center the tooltip */
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>

<body>

    <div class="table-container">
        <h1>Weather Information in Manila</h1> <input type="text" id="search" placeholder="Search location..."
            onkeyup="filterTable()">

        <table>
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Elevation (m)</th>
                    <th>Feature Code </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weatherData["results"] as $result)
                    <tr>
                        <td>
                            <img class="flag" src="https://flagcdn.com/{{ strtolower($result['country_code']) }}.svg"
                                alt="{{ $result['country_code'] }} flag">
                            {{ $result["name"] }}
                        </td>
                        <td>{{ $result["longitude"] }}</td>
                        <td>{{ $result["latitude"] }}</td>
                        <td>{{ $result["elevation"] }}</td>
                        <td>{{ $result["feature_code"] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        // Replace 'YOUR_API_KEY' with your OpenWeatherMap API key
        async function fetchWeatherData() {
            const response = await fetch('https://api.openweathermap.org/data/2.5/weather?q=Manila&appid=YOUR_API_KEY');
            const data = await response.json();
            const weatherCondition = data.weather[0].main.toLowerCase();
            setWeatherBackground(weatherCondition);
        }

        function setWeatherBackground(condition) {
            const body = document.body;
            switch (condition) {
                case 'clear':
                    body.style.backgroundImage = "url('path/to/clear-sky.gif')";
                    break;
                case 'rain':
                    body.style.backgroundImage = "url('path/to/rainy.gif')";
                    break;
                case 'snow':
                    body.style.backgroundImage = "url('path/to/snow.gif')";
                    break;
                default:
                    body.style.backgroundImage = "url('path/to/default-weather.gif')";
            }
            body.style.backgroundSize = 'cover';
            body.style.backgroundRepeat = 'no-repeat';
        }

        fetchWeatherData();

        function filterTable() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const table = document.querySelector('table tbody');
            const rows = table.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const locationCell = rows[i].getElementsByTagName('td')[0];
                if (locationCell) {
                    const location = locationCell.textContent || locationCell.innerText;
                    rows[i].style.display = location.toLowerCase().includes(searchInput) ? '' : 'none';
                }
            }
        }

    </script>
</body>

</html>