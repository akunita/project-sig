<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Peta Kecamatan dan Layanan Kesehatan Banyumas</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        #map {
            height: 600px;
        }
    </style>
</head>

<body>
    <h1>Peta Kecamatan dan Layanan Kesehatan Kabupaten Banyumas</h1>
    <a href="crud.php" target="_blank">
        <button>Data</button>
    </a>
    <div id="map" style="height: 700px;"></div>
    <script type="text/javascript" src="data/kecamatan.json"></script>
    <script>
        // Inisialisasi peta dengan koordinat dan zoom level awal
        const map = L.map('map').setView([-7.450161992561026, 109.16218062235068], 11);

        // Menambahkan layer tile dari OpenStreetMap
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Menambahkan polygon untuk Kecamatan dengan gaya tertentu
        L.geoJSON(kecamatan, {
            style: function(feature) {
                return {
                    color: 'blue',
                    weight: 2
                };
            }
        }).addTo(map);

        // Menambahkan titik layanan kesehatan dari database
        <?php
        include 'db_connection.php';
        
        $sql = 'SELECT name, latitude, longitude FROM health_services';
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                $latitude = $row['latitude'];
                $longitude = $row['longitude'];
        
                echo "L.marker([$latitude, $longitude]).addTo(map)
                      .bindPopup('<b>$name</b>');\n";
            }
        }
        
        $conn->close();
        ?>
    </script>

</body>

</html>
