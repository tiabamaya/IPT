<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
    <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Mincho&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Sawarabi Mincho', serif;
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
            color: #fff;
        }

        h1 {
            text-align: center;
            color: #fff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            font-size: 2.5em;
        }

        .table-container {
            position: relative;
            width: 80%;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(139, 0, 0, 0.8), 0 0 25px rgba(139, 0, 0, 0.6);
            backdrop-filter: blur(5px);
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
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        tr:hover {
            background-color: rgba(139, 0, 0, 0.3);
        }

        img.flag {
            width: 30px;
            height: auto;
            vertical-align: middle;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="table-container">
        <h1>Weather Information in Japan</h1>
        <table id="weather-table">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Elevation (m)</th>
                    <th>Feature Code</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic content will be inserted here -->
            </tbody>
        </table>
    </div>

    <script>
        async function fetchWeatherData() {
            try {
                const response = await fetch('https://geocoding-api.open-meteo.com/v1/search?name=japan&count=10&language=en&format=json');
                const data = await response.json();

                // Iterate over each result and create table rows
                const tableBody = document.querySelector('#weather-table tbody');
                data.results.forEach(result => {
                    const row = `
                        <tr>
                            <td>
                                <img class="flag" src="https://flagcdn.com/${result.country_code.toLowerCase()}.svg" alt="${result.country_code} flag">
                                ${result.name}
                            </td>
                            <td>${result.longitude}</td>
                            <td>${result.latitude}</td>
                            <td>${result.elevation || 'N/A'}</td>
                            <td>${result.feature_code || 'N/A'}</td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });

            } catch (error) {
                console.error('Error fetching weather data:', error);
            }
        }

        // Call the function to fetch weather data on page load
        fetchWeatherData();
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\IPT\Laravel\simpleApi\IPT\resources\views/weather.blade.php ENDPATH**/ ?>