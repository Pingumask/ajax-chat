<?php
require_once('./Model/Message.class.php');
$messageList=Message::getLastMessages();
$lastId=Message::getLastId();
require('./View/messagerie.php');