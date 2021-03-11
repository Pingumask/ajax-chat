<?php

require_once('./Model/pdo.php');

class Message{
    public ?int $id_message;
    public string $creation_time;
    public string $user;
    public string $content;

    /**
     * @return Array La liste des messages de moins d'une heure
     */
    public static function getLastMessages():Array{
        $request=$GLOBALS['database']->prepare("SELECT * FROM messages WHERE creation_time>DATE_SUB(NOW(),INTERVAL 1 HOUR) ORDER BY id_message ASC LIMIT 50");
        $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS,'Message');
    }

    /**
     * Retourne l'id du dernier message inséré
     *
     * @return integer l'id du dernier message inséré ou 0 si aucune entrée dans la base de données
     */
    public static function getLastId():int{
        $request=$GLOBALS['database']->prepare("SELECT id_message FROM messages ORDER BY id_message DESC LIMIT 1");
        $request->execute();
        if($result=$request->fetch()) return $result['id_message'];
        return 0;
    }

    /**
     * @param string $user L'utilisateur qui envoie le message
     * @param string $content Le contenu du message
     */
    public static function sendMessage(string $user, string $content):void{
        $request=$GLOBALS['database']->prepare("INSERT INTO messages (creation_time, user, content) VALUES (NOW(), :user, :content)");
        $request->execute([
            ':user'=>$user,
            ':content'=>$content
        ]);
    }

    /**
     * @param string $minId L'Id du message le plus récent à refuser
     * @return Array La liste des nouveaux messages
     */
    public static function getNewMessages(string $minId):Array{
        $request=$GLOBALS['database']->prepare("SELECT * FROM messages WHERE id_message>:minId ORDER BY creation_time ASC");
        $request->execute([':minId'=>$minId]);
        return $request->fetchAll(PDO::FETCH_CLASS,'Message');
    }
}