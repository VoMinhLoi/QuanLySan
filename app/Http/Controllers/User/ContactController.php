<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use OpenAI\Laravel\Facades\OpenAI;
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;
use Illuminate\Database\QueryException;

class ContactController extends Controller
{
    public function index()
    {
        return view('Pages.contact');
    }

    // public function sendChat(Request $request)
    // {
    //     try {
    //         $result = OpenAI::completions()->create([
    //             'temperature' => 0,
    //             'max_tokens' => 2048,
    //             'model' => 'gpt-3.5-turbo-instruct',
    //             'prompt' => $request->input('input')
    //         ]);

    //         if ($result && isset($result['choices'])) {
    //             $response = array_reduce(
    //                 $result['choices'],
    //                 fn (string $result, array $choice) => $result . $choice['text'],
    //                 ''
    //             );
    //             return $response;
    //         } else {
    //             return "No response from OpenAI API.";
    //         }
    //     } catch (\Exception $e) {
    //         return "An error occurred: " . $e->getMessage();
    //     }
    // }
    public function sendChat(Request $request)
    {
        try {
            $client = new Client("AIzaSyBPktXJboMB_v9Pa7EZYcR1J5SQYVJwJSM");
            $response = $client->geminiPro()->generateContent(
                new TextPart($request->text)
            );
            return json_encode(['text' => $response->text()]);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Chatbot đang quá tải.', 'message' => $e->getMessage()], 500);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Chatbot đang quá tải.', 'message' => $e->getMessage()], 500);
        }
    }
}
