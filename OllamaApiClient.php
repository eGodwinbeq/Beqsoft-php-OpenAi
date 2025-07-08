<?php
// OllamaApiClient.php
class OllamaApiClient {
    private $apiUrl;

    public function __construct($apiUrl = 'http://localhost:11434/api/chat') {
        $this->apiUrl = $apiUrl;
    }

    public function chat($model, $messages) {
        $data = [
            'model' => $model,
            'messages' => $messages
        ];

        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            throw new Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        if ($httpCode !== 200) {
            throw new Exception("API request failed with HTTP code $httpCode");
        }

        return json_decode($response, true);
    }
}