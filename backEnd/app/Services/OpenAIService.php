<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class OpenAIService
{
    protected Client $client;
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'timeout'  => 60,
        ]);

        $this->apiKey = env('OPENAI_API_KEY');
        $this->model  = env('OPENAI_MODEL', 'gpt-4o-mini');
    }

    /** Synchronous (tanpa streaming) */
    public function chat(string $prompt, array $options = []): array
    {
        $payload = array_merge([
            'model' => $this->model,
            'input' => $prompt,
        ], $options);

        try {
            $res  = $this->client->post('responses', [
                'headers' => [
                    'Authorization' => "Bearer {$this->apiKey}",
                    'Content-Type'  => 'application/json',
                ],
                'json' => $payload,
            ]);

            $data = json_decode((string) $res->getBody(), true);

            // Responses API menyediakan field ringkas `output_text`
            $text = $data['output_text'] ?? null;

            return ['ok' => true, 'text' => $text, 'raw' => $data];
        } catch (RequestException $e) {
            return [
                'ok'    => false,
                'error' => $e->getMessage(),
                'body'  => (string) optional($e->getResponse())->getBody()
            ];
        }
    }

    /** Streaming: pass-through SSE dari OpenAI */
    public function stream(string $prompt, \Closure $onChunk, array $options = []): void
    {
        $payload = array_merge([
            'model'  => $this->model,
            'input'  => $prompt,
            'stream' => true, // minta SSE
        ], $options);

        $res = $this->client->post('responses', [
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type'  => 'application/json',
                'Accept'        => 'text/event-stream',
            ],
            'json'   => $payload,
            'stream' => true, // jangan buffer response
        ]);

        $body = $res->getBody();
        while (!$body->eof()) {
            $chunk = $body->read(1024);
            if ($chunk !== '') {
                $onChunk($chunk);
            }
        }
    }
}
