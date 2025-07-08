<?php
set_time_limit(0);
session_start();
$userMessage = $_POST['message'];

$messages = $_SESSION['log'] ?? [];
$messages[] = ["role" => "user", "content" => $userMessage];

$data = [
    "model" => "phi",
    "messages" => $messages
];

$ch = curl_init('http://localhost:11434/api/chat');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);
curl_close($ch);

// Handle streaming response
$lines = explode("\n", trim($response));
$fullContent = '';

foreach ($lines as $line) {
    if (!empty($line)) {
        $data = json_decode($line, true);
        if (isset($data['message']['content'])) {
            $fullContent .= $data['message']['content'];
        }
    }
}

$reply = trim($fullContent) ?: 'Something went wrong.';

$messages[] = ["role" => "assistant", "content" => $reply];
//var_dump($reply);
$_SESSION['log'] = $messages;

header('Location: index.php');
exit;