<?php
require_once('./Model/Message.class.php');
$messageList=Message::getNewMessages($_GET['min']);
header('Content-Type: application/json');
echo json_encode($messageList);