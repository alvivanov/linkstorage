<?php init_header($title); ?>

<?php if(is_array($links)) : ?>
    <table border="1">
        <thead>
            <th>Название</th>
            <th>Ссылка</th>
        </thead>
            <?php foreach($links as $link): ?>
                <tr>
                    <td><?=$link['title']?></td>
                    <td><a href="<?=$link['url']?>" target="_blank"><?=$link['link']?></a></td>
                </tr>
            <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Ссылок не найдено!</p>
<?php endif; ?>

<?php init_footer(); ?>
