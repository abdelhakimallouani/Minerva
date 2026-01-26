<?php

namespace App\models\Entities;

class ChatMessage{
    private $id_chat;
    private $id_classe;
    private $id_user;
    private $message;
    private $created_at;

    public function getId(){
        return $this->id_chat;
    }
    public function setId($id_chat){
        $this->id_chat=$id_chat;
    }

    public function getMessage(){
        return $this->message;
    }
    public function setMessage($message){
        $this->message=$message;
    }
    
    public function getIdClasse() {
        return $this->id_classe; 
    }
    public function setIdClasse($id_classe) {
        $this->id_classe = $id_classe;
    }

    public function getIdUser() { 
        return $this->id_user;
    }
    public function setIdUser($id_user) { 
        $this->id_user = $id_user;
    }

    public function getCreatedAt() { 
        return $this->created_at;
    }
    public function setCreatedAt($created_at) { 
        $this->created_at = $created_at;
    }
}

?>