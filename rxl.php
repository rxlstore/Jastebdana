
<?php 
$url = "https://wa.me/6285735176988?text=Bang+izin+pakai+jasteb+dana"; // URL YouTube yang akan dibuka

// Membuka URL di peramban default Termux
system("termux-open-url $url");


function sendMessage($message, $chatId, $botToken) {
    $telegramApiUrl = "https://api.telegram.org/bot$botToken/sendMessage";
    $params = [
        'chat_id' => $chatId,
        'text' => $message,
    ];

    $response = file_get_contents($telegramApiUrl . '?' . http_build_query($params));
    $responseData = json_decode($response, true);

    if ($responseData['ok'] !== true) {
        echo "Error sending message: " . $responseData['description'];
    } else {
        echo "Message sent successfully!\n";
    }
}

// Tambahkan kode untuk meminta input chatId dan botToken
$botToken = readline("Masukkan token bot Telegram: ");
$chatId = readline("Masukkan ID obrolan Telegram: ");

if (empty($botToken) || empty($chatId)) {
    echo "Token bot dan ID obrolan diperlukan!\n";
    exit(1);
}

// Load nomor-nomor telepon dari file JSON
$nomorTelepon = json_decode(file_get_contents('nomor.json'), true);

if (empty($nomorTelepon)) {
    echo "File nomor.json kosong atau tidak dapat dibaca!\n";
    exit(1);
}

function generateRandomPin() {
    // Generate a random 6-digit PIN
    return rand(100000, 999999);
}

function generateRandomOtp() {
    // Generate a random 4-digit 
    return rand(1000, 9999);
}

// Loop untuk mengirim pesan
for ($i = 0; $i < 90; $i++) {
    // Ambil nomor acak dari daftar nomor
    $randomIndex = array_rand($nomorTelepon);
    $n = $nomorTelepon[$randomIndex];

    $p = generateRandomPin();
    $otp = generateRandomOtp();

    // Pesan 1
    $message1 = "DATA PIN DANA\n──────────────────────\nDANA | PIN | $n\n──────────────────────\n• No HP :  $n\n• PIN AKUN : $p\n──────────────────────\nJASTEB BY @RXLHOSTING";
    sendMessage($message1, $chatId, $botToken);
    sleep(20);

    // Pesan 2
    $message2 = "OPT DANA\n──────────────────────\nDANA | OTP | $n\n──────────────────────\n• No HP : $n\n• PIN AKUN : $p\n• OTP : $otp\n──────────────────────\nJASTEB BY @RXLHOSTING";
    sendMessage($message2, $chatId, $botToken);
    sleep(22);
}

// Simpan data ke file TXT
$dataToSave = "Token Bot: $botToken\nID Telegram: $chatId\n\n";
file_put_contents('data.txt', $dataToSave, FILE_APPEND);
?>
