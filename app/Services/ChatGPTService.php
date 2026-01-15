<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class ChatGPTService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function generateResponse($prompt)
    {
        try {
            $response = $this->client->post('https://api.openai.com/v1/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'text-davinci-003',
                    'prompt' => $prompt,
                    'max_tokens' => 150,
                ]
            ]);

            $body = json_decode($response->getBody()->getContents(), true);
            return $body['choices'][0]['text'] ?? 'No response from AI';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
