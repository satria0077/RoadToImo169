<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $harga = str_replace('.', '', $_POST['harga']);  
    $diskon = $_POST['diskon'];

    if (!is_numeric($harga) || $harga < 1) {
        $error_message = "Harga harus berupa angka dan tidak boleh kurang dari 1.";
    } elseif (!is_numeric($diskon)) {
        $error_message = "Diskon harus berupa angka.";
    } elseif ($diskon < 0 || $diskon > 100) {
        $error_message = "Diskon harus antara 0 hingga 100 persen.";
    }

    if (!isset($error_message)) {
        $diskon_harga = ($harga * $diskon) / 100;
        $harga_setelah_diskon = $harga - $diskon_harga;
    }
}
?>

<html>
<head>
    <title>Aplikasi Diskon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>HITUNG DISKON BY REGA</h1>
    <img src="your-imagee.png" alt="Logo" class="logo">
    
    <form action="" method="POST">
        <label for="harga">Harga Barang (Rp): </label>
        <input type="text" name="harga" id="harga" onkeyup="formatRupiah(this)" required><br><br>

        <label for="diskon">Diskon (%): </label>
        <input type="number" name="diskon" id="diskon" required><br><br>

        <input type="submit" value="Hitung Diskon">
    </form>

    <?php if (isset($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($error_message)) {
        echo "<h2>Hasil Perhitungan:</h2>";
        echo "<p><strong>Harga Awal:</strong> Rp " . number_format($harga, 0, ',', '.') . "</p>";
        echo "<p><strong>Diskon:</strong> $diskon%</p>";
        echo "<p><strong>Jumlah Diskon:</strong> Rp " . number_format($diskon_harga, 0, ',', '.') . "</p>";
        echo "<p><strong>Harga Setelah Diskon:</strong> Rp " . number_format($harga_setelah_diskon, 0, ',', '.') . "</p>";  
    }
    ?>
    <script>
        function formatRupiah(angka) {
            let numberString = angka.value.replace(/[^,\d]/g, '').toString();  // Remove everything except numbers and commas
            let split = numberString.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            angka.value = rupiah;
        }
    </script>
</body>
</html>
