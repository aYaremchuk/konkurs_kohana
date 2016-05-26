<strong>Список всех статей</strong>

<br /><br />

<?php foreach($articles as $article): ?>
 
    <div style="padding:10px; margin-bottom:10px; border:#333 1px dashed;">
        <strong><?php echo $article['title']; ?></strong><br />
        <i>Автор: <?php echo $article['author']; ?></i> / 
        <i>Дата публикации: <?php echo $article['date']; ?></i><br /><br />
        <p><?php echo $article['content_short']; ?></p>
        <p style="text-align:right; text-decoration:underline;">
            <a href="<?php echo URL::site('articles/'. $article['id'] .'-'. $article['alt_title']); ?>">Подробнее</a>
        </p>
    </div>
 
<?php endforeach; ?>