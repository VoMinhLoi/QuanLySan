<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PusherController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function broadcast(Request $request)
    {
        $account = Auth::user()->taiKhoan;
        $authCode = Auth::user()->maQuyen;
        $timestamp = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh')->toDateTimeString();

        broadcast(new PusherBroadcast(
            $request->get('message'),
            $account,
            $authCode,
            $timestamp
        ))->toOthers();
        return response()->json([
            'html' => view('chat.broadcast', [
                'message' => $request->get('message'),
                'account' => $account,
                'authCode' => $authCode,
                'timestamp' => $timestamp
            ])->render()
        ]);
    }

    public function receive(Request $request)
    {
        return response()->json([
            'html' => view('chat.receive', [
                'message' => $request->get('message'),
                'account' => $request->get('account'),
                'authCode' => $request->get('authCode'),
                'timestamp' => $request->get('timestamp')
            ])->render()
        ]);
    }
}
