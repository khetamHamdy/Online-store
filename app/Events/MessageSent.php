<?php
namespace App\Events;
use App\Models\ChatMessages;
use App\Models\Chat;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class MessageSent implements ShouldBroadcast
{
use Dispatchable, InteractsWithSockets, SerializesModels;
public $message;
public $count;
public $user;
/**
* Create a new event instance.
*
* @return void
*/
public function __construct(User $user , ChatMessages $message)
{
$this->message = ChatMessages::where('id',$message->id)->get();
$this->user = $user;
$this->count = 1;
}
/**
* Get the channels the event should broadcast on.
*
* @return \Illuminate\Broadcasting\Channel|array
*/
public function broadcastOn(){
    
    return new Channel('chat.'.$this->user->id);
}
public function broadcastWith(){
    
    $chats = Chat::where('id',$this->message[0]->chat_id)->get();
    $view = view('admin.chats.recived_messages')->with(['messages'=>$this->message])->render();
    $view2 = view('admin.chats.reciver_mor_chats')->with(['items'=>$chats])->render();
    return ['message' => $this->message ,'user'=>$this->user ,'view'=>$view ,'itemChat'=>$view2,'chat_id'=>$this->message[0]->chat_id];
}
}