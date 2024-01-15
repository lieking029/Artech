<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use OpenAI\Laravel\Facades\OpenAI;

class ImageGenerationController extends Controller
{
    public function imageGenerate()
    {
        $categories = Category::all();

        $prompt = request('prompt');
        $n = request('picture');
        $size = request('size');
        $imageUrl = [];

        if ($prompt) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->withToken(env('OPENAI_API_KEY'))
                ->post('https://api.openai.com/v1/images/generations', [
                    'prompt' => $prompt,
                    'n' => (int) $n,
                    'size' => $size,
                ]);

            if ($response->successful() && isset($response->json()['data'])) {
                $data = $response->json()['data'];

                foreach ($data as $image) {
                    $imageUrl[] = $image['url'];
                }
            }
        }

        return view('imageGeneration.index', compact('categories', 'imageUrl'));
    }
}
