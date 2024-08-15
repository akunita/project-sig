<?php
include 'db_connection.php';
// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
// Ambil data untuk ID tersebut
$query = "SELECT * FROM health_services WHERE id=$id";
$result = $conn->query($query);
if ($result->num_rows == 0) {
    die('Data tidak ditemukan.');
}
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Edit Data</title>
</head>

<body>
    <h1>Edit Data Layanan Kesehatan</h1>
    <form action="crud.php" method="post">
        <input type="hidden" name="id" value="<?php echo $data['id'];
        ?>">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($data['name']); ?>" required><br>
        <label for="address">Alamat:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($data['address']); ?>" required><br>
        <label for="latitude">Latitude:</label>
        <input type="number" step="any" id="latitude" name="latitude" value="<?php echo htmlspecialchars($data['latitude']); ?>" required><br>
        <label for="longitude">Longitude:</label>
        <input type="number" step="any" id="longitude" name="longitude" value="<?php echo htmlspecialchars($data['longitude']); ?>" required><br>
        <button type="submit" name="update">Simpan</button>
        <a href="crud.php"><button>Kembali</button></a>
    </form>
</body>

</html>
<?php $conn->close(); ?>
