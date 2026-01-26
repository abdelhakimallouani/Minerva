<?php
namespace App\Controllers;

use App\models\Services\ChatService;
use App\models\Repositories\ChatRepository;
use App\Core\Database;

class ChatController {
    private $chatService;

    public function __construct() {
        $db = Database::getInstance()->getConnection();
        $repo = new \App\Models\Repositories\ChatRepository($db);
        $this->chatService = new ChatService($repo);
    }

    public function send() { 
        $messageText = $_POST['message'] ?? '';
        $userId = $_SESSION['user']['id'] ?? $_SESSION['user_id'] ?? null; 
        $classId = $_POST['id_classe'] ?? null;

        if (!$classId) {
        die("Erreur: ID de classe manquant.");
        }

        try {
            $this->chatService->sendMessage($classId, $userId, $messageText);

            header("Location: /chat/view/" . $classId);
            exit();
        } catch (\Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header("Location: /chat/view/" . $classId);
            exit();
        }
    }

    public function show($id = null) {
        $classId = $id ?? $_SESSION['class_id'] ?? 1;
        $messages = $this->chatService->getMessagesForClass($classId);
        require_once __DIR__ . '/../views/chat/view.php';
    }
}