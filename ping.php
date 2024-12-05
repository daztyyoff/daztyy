<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = 8086168051:AAFFb4uqsGyK3tAHYifeFwjd17ZlGZ88p6Y;  // Замените на ваш токен
    $chat_id = 1085992226;    
    $message = "Кто-то нажал на кнопку 'Пинг!' на сайте.";  // Сообщение

    // URL для отправки запроса
    $url = "https://api.telegram.org/bot{$token}/sendMessage";

    // Параметры запроса
    $data = [
        'chat_id' => $chat_id,
        'text' => $message
    ];

    // Отправка запроса
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result) {
        echo "Пинг отправлен в Telegram!";
    } else {
        echo "Ошибка при отправке пинга.";
    }
} else {
    echo "Неверный запрос.";
}
?>
