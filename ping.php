<?php
// Ваш токен и chat_id
$bot_token = "8086168051:AAFFb4uqsGyK3tAHYifeFwjd17ZlGZ88p6Y";
$chat_id = "1085992226";

// Сообщение для отправки
$message = "Пинг!";

// Формируем URL для запроса к API Telegram
$api_url = "https://api.telegram.org/bot$bot_token/sendMessage?chat_id=$chat_id&text=" . urlencode($message);

// Отправляем запрос
file_get_contents($api_url);
?>
