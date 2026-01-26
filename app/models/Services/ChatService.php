<?php

namespace App\models\Services;

use App\models\repositories\ChatRepository;
use App\models\Entities\ChatMessage;

class ChatService{
    private $ChatRepository;

    public function __construct(ChatRepository $ChatRepository)
    {
        $this->ChatRepository=$ChatRepository;
    }

    public function sendMessage($classId, $userId, $text){
        $text = trim(htmlspecialchars($text));

        if (empty($text)) {
            throw new \Exception("message ne peux pas envoyer vide");
        }

        $message = new ChatMessage();
        $message->setIdClasse($classId);
        $message->setIdUser($userId);
        $message->setMessage($text);

        return $this->ChatRepository->save($message);
    }

    public function getMessagesForClass($classId) {
        return $this->ChatRepository->findByClasse($classId);
    }

}

?>