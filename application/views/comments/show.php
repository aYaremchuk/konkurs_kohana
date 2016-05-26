<?php foreach($comments as $comment): ?>
 
    <div style="padding:10px; margin-bottom:10px; border-bottom:#999 1px dashed;">
        <strong><?php echo HTML::chars($comment['user']); ?></strong><br />
        <?php echo HTML::chars($comment['message']); ?>
    </div>
 
<?php endforeach; ?>
 
<div style="padding:10px;">
    <form action="" method="post">
        Ваше имя: <br />
        <input name="user" type="text" /><br /><br />
        Сообщение: <br />
        <textarea name="message" cols="25" rows="5"></textarea><br /><br />
        <input name="send" type="submit" value="Отправить" />
    </form>
</div>