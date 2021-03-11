<?php include('./View/Component/header.php');?>
<main>
    <section id="message_list">
        <?php foreach ($messageList as $message): ?>
            <div class="message">
                <div class="user"><?= $message->user?></div>
                <div class="creation_time"><?= $message->creation_time?></div>
                <div class="content"><?= $message->content?></div>
            </div>
        <?php endforeach ?>
    </section>
    <form action="handle_message.php">
        <input type="text" name="user" placeholder="User" required/>
        <input type="text" name="content" placeholder="Message" required/>
        <input type="submit" value="✉"/>
    </form>
</main>
<?php include('./View/Component/footer.php');?>