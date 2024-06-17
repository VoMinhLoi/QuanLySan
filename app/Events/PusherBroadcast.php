<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;
    public string $account;
    public string $authCode;
    public string $timestamp;

    public function __construct(string $message, string $account, string $authCode, string $timestamp)
    {
        $this->message = $message;
        $this->account = $account;
        $this->authCode = $authCode;
        $this->timestamp = $timestamp;
    }

    public function broadcastOn(): array
    {
        return ['public'];
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
