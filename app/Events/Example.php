<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Example implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public string $queue = 'chat';

    public function broadcastQueue(): string
    {
        return 'chat';
    }
    
    public function __construct(protected User $user, protected Message $message)
    {

    }

    public function broadcastWith() : array
    {
        return [
        'user' => [
            'id'=>$this->user->id,
            'name'=>$this->user->name
        ],
        'message' => [
            'id' => $this->message->id
        ]
        ];
    }


    public function broadcastOn(): array
    {
        return [
            new Channel('chat'),
        ];
    }
}
