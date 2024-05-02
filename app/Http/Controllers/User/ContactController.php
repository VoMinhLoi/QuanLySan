<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ContactController extends Controller
{
    public function index()
    {
        return view('Pages.contact');
    }

    public function sendChat(Request $request)
    {
        $result = OpenAI::completions()->create([
            'max_tokens' => 100,
            'model' => 'gpt-3.5-turbo-0125',
            'prompt' => $request->input('input')
        ]);
        $response = array_reduce(
            $result->toArray()['choices'],
            fn (string $result, array $choice) => $result . $choice['text'],
            ''
        );
        return $response;
    }
}
