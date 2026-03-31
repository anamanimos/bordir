<?php
require_once 'vendor/autoload.php';

$client = new Google\Client();
$client->setAuthConfig('application/config/credentials.json'); // Path ke kredensial Anda
$client->setRedirectUri('http://localhost'); // Sesuaikan dengan URI pengalihan yang valid
$client->addScope(Google\Service\Drive::DRIVE); // Scope untuk akses Google Drive
$client->setAccessType('offline'); // Meminta refresh token untuk akses offline

// Membuat URL otorisasi untuk mendapatkan kode autentikasi
$authUrl = $client->createAuthUrl();
echo "Buka URL berikut di browser Anda untuk autentikasi:\n";
echo $authUrl . "\n";

// Tunggu input kode autentikasi dari pengguna
echo "Masukkan kode autentikasi: ";
$authCode = trim(fgets(STDIN));

// Tukarkan kode autentikasi dengan token akses
$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

// Simpan token ke file untuk penggunaan di masa mendatang
$tokenPath = 'application/config/token.json'; // Lokasi file token.json
if (!file_exists(dirname($tokenPath))) {
    mkdir(dirname($tokenPath), 0700, true);
}
file_put_contents($tokenPath, json_encode($accessToken));
echo "Token disimpan ke: " . $tokenPath . PHP_EOL;

// Menyimpan refresh token di tempat yang aman (untuk digunakan di masa depan)
if (isset($accessToken['refresh_token'])) {
    echo "Refresh Token: " . $accessToken['refresh_token'] . PHP_EOL;
} else {
    echo "Tidak ada refresh token. Pastikan Anda telah mengatur accessType ke 'offline' dan memberikan izin yang sesuai.\n";
}
?>
