<?php
require_once('./Model/Message.class.php');
$messageList=Message::getLastMessages();
require('./View/messagerie.php');