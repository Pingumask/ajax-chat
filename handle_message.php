<?php
require_once('./Model/Message.class.php');
Message::sendMessage($_POST['user'],$_POST['content']);