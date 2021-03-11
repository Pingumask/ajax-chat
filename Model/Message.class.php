<?php

require_once('./Model/pdo.php');

class Message{
    private ?int $id_message;
    public string $creation_time;
    public string $user;
    public string $content;

    /**
     * @return Array La liste des X messages les plus récents
     */
    public static function getLastMessages():Array{
        $request=$GLOBALS['database']->prepare("SELECT * FROM messages ORDER BY creation_time DESC LIMIT 50");
        $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS,'Message');
    }

    /**
     * @param string $user L'utilisateur qui envoie le message
     * @param string $content Le contenu du message
     */
    public static function sendMessage(string $user, string $content):void{
        $request=$GLOBALS['database']->prepare("INSERT INTO messages (creation_time, user, content) VALUES (:creation_time, :user, :content)");
        $request->execute([
            ':creation_time'=>Date('YYYY-mm-dd hh:ii:ss'),
            ':user'=>$user,
            ':content'=>$content
        ]);
    }

    /**
     * @param string $minDate La date du plu vieux message autorisé
     * @return Array La liste des nouveaux messages
     */
    public static function getNewMessages(string $minDate):Array{
        $request=$GLOBALS['database']->prepare("SELECT * FROM messages WHERE creation_time>:minDate ORDER BY creation_time ASC");
        $request->execute([':minDate'=>$minDate]);
        return $request->fetchAll(PDO::FETCH_CLASS,'Message');
    }
}