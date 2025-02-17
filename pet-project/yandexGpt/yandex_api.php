<?php

class YandexGPT
{
    private $url = "https://llm.api.cloud.yandex.net/foundationModels/v1/completion";
    private $API_KEY_YANDEXGPT = 'AQVNxO_kb979AzoDabFXNbZZNBzUbcv8bp3k4a2M';
    private $API_MODEL_YANDEXGPT = 'b1g7e8i5ggkolr8acjc6';

    public function gptAnswer($prompt)
    {
        $data = [
            "modelUri" => 'gpt://' . $this->API_MODEL_YANDEXGPT . '/yandexgpt-lite',
            "completionOptions" => [
                "stream" => false,
                "temperature" => 0.6,
                "maxTokens" => 2000
            ], 
            "messages" => [
                [
                    "role" => "system",
                    "text" => $prompt
                ]
            ]
        ];

        $headers = [
            'Authorization: Api-Key ' . $this->API_KEY_YANDEXGPT,
            'Content-Type: application/json',
        ];

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($response, true);
    }
}

// Пример использования класса YandexGPT
$yandexGPT = new YandexGPT();
$response = $yandexGPT->gptAnswer("Привет, как дела?");
echo '<pre>';
print_r($response);
echo '</pre>';
?>