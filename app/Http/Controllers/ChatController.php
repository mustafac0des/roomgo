<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChatGptService;

class ChatController extends Controller
{
    protected $chatGptService;

    public function __construct(ChatGptService $chatGptService)
    {
        $this->chatGptService = $chatGptService;
    }

    public function index()
    {
        return view('chat.index'); 
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $userMessage = $request->input('message');
        $response = $this->chatGptService->getResponse($userMessage);

        return response()->json(['response' => $response]);
    }
}
