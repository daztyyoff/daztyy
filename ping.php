<?php
// Получаем данные от клиента (если отправляется JSON)
$data = json_decode(file_get_contents("php://input"), true);

// Если данные не пришли
if (!$data) {
    echo json_encode(["status" => "error", "message" => "Нет данных"]);
    exit;
}

// Ваши настройки Firebase
$serverKey = "YOUR_SERVER_KEY";  // Получите Server Key из Firebase Console
$token = "DEVICE_FCM_TOKEN";  // Токен устройства, полученный ранее

// Подготовка данных для отправки уведомления
$notificationData = [
    "to" => $token,
    "notification" => [
        "title" => "Пинг!",
        "body"  => $data['message'] // Текст уведомления
    ]
];

// Заголовки для отправки запроса к Firebase
$headers = [
    'Authorization: key=' . $serverKey,
    'Content-Type: application/json'
];

// Инициализация cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notificationData));

// Выполняем запрос и получаем ответ
$response = curl_exec($ch);
curl_close($ch);

// Проверяем, есть ли ошибка
if ($response === FALSE) {
    echo json_encode(["status" => "error", "message" => "Ошибка при отправке уведомления"]);
} else {
    echo json_encode(["status" => "success", "message" => "Уведомление отправлено", "response" => $response]);
}
?>
