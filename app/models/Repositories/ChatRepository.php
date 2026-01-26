<?php

namespace App\models\Repositories;

use App\Core\Database;
use App\models\Entities\ChatMessage;
use PDO;

class ChatRepository{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db=$db;
    }

    public function save(ChatMessage $chatMessage){
        $save=$this->db->prepare("INSERT INTO chat_messages (id_classe, id_user, message) VALUES (?,?,?) ");
        $save->execute([
            $chatMessage -> getIdClasse(),
            $chatMessage -> getIdUser(),
            $chatMessage -> getMessage()
        ]);
    }

    public function findByClasse($id_classe){
        $findClasse=$this->db->prepare("SELECT*FROM chat_messages WHERE id_classe = ? ORDER BY created_at ASC");
        $findClasse->execute([$id_classe]);
        return $findClasse->fetchAll(PDO::FETCH_CLASS, ChatMessage::class);
    }
}


?>