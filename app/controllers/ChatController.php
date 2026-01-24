<?php

namespace App\controllers\chat;

use App\models\Services\chat\ChatService;

class ChatController{
    private $chatService;

    public function __construct(ChatService $chatService) {
        $this->chatService = $chatService;
    }

    public function send(){
        $messageText = $_POST['message'] ?? '';
        $classId = $_POST['id_classe'] ?? null;

        $userId = $_SESSION['user_id'];

        try{
            $this->chatService->sendMessage($classId, $userId, $messageText);
            header("Location: /chat/view?id_classe=" . $classId);
            exit();
        }catch(\Exception $e){
            $_SESSION['error'] = $e->getMessage();
            header("Location: /chat/view?id_classe=" . $classId);
            exit();
        }
    }
}

?>