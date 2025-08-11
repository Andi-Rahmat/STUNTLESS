<?php

namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class aiController extends Controller
{
 public function chat(Request $request, OpenAIService $openai)
    {
        $request->validate(['prompt' => 'required|string|min:1']);
        $result = $openai->chat($request->input('prompt'));

        if (!$result['ok']) {
            return response()->json($result, 422);
        }
        return response()->json(['reply' => $result['text']]);
    }

    public function stream(Request $request, OpenAIService $openai)
    {
        $request->validate(['prompt' => 'required|string|min:1']);
        $prompt = $request->input('prompt');

        $response = new StreamedResponse(function () use ($openai, $prompt) {
            // Kirim event awal (opsional)
            echo "data: " . json_encode(['type' => 'start']) . "\n\n";
            @ob_flush(); @flush();

            $openai->stream($prompt, function ($chunk) {
                // Langsung teruskan potongan SSE dari OpenAI ke klien
                echo $chunk;
                @ob_flush(); @flush();
            });

            // Tanda selesai
            echo "data: [DONE]\n\n";
            @ob_flush(); @flush();
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('X-Accel-Buffering', 'no'); // Nginx: matikan buffering

        return $response;
    }
}

