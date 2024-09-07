<?php
// Path ke file counter.txt
$file = 'counter.txt';

// Waktu saat ini (Unix timestamp)
$current_time = time();

// Durasi reset dalam detik (1 jam = 3600 detik)
$reset_interval = 3600; // 1 jam

// Baca isi file counter dan waktu reset terakhir
if (file_exists($file)) {
    $data = file($file, FILE_IGNORE_NEW_LINES); // Baca file, baris per baris
    $counter = (int)$data[0]; // Baris pertama: jumlah kunjungan
    $last_reset_time = (int)$data[1]; // Baris kedua: waktu reset terakhir
} else {
    // Jika file tidak ditemukan, mulai dari 0 dan waktu sekarang
    $counter = 0;
    $last_reset_time = $current_time;
}

// Cek apakah sudah 1 jam sejak reset terakhir
if ($current_time - $last_reset_time >= $reset_interval) {
    // Jika sudah lebih dari 1 jam, reset counter ke 1
    $counter = 1;
    // Perbarui waktu reset terakhir
    $last_reset_time = $current_time;
} else {
    // Tambahkan 1 ke counter
    $counter++;
}

// Tulis kembali nilai counter dan waktu reset terakhir ke file
file_put_contents($file, $counter . PHP_EOL . $last_reset_time);

// Tampilkan jumlah kunjungan
echo "<h1>Total Kunjungan: " . $counter . "</h1>";
echo "<p>Counter akan di-reset setiap 1 jam.</p>";
?>
