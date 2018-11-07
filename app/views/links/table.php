<?php init_header($title); ?>
<?php if(is_array($links)) : ?>
    <table border="1">
        <thead>
            <th>Название</th>
            <th>Ссылка</th>
            <th>Действия</th>
        </thead>
        <?php foreach($links as $link): ?>
            <tr>
                <td><a href="/links/view/<?=$link['id']?>"><?=$link['title']?></a></td>
                <td><a href="<?=$link['url']?>" target="_blank"><?=$link['link']?></a></td>
                <td>
                    <a href="/links/delete/<?=$link['id']?>">Delete</a>
                    <a href="/links/edit/<?=$link['id']?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Ссылок не найдено!</p>
<?php endif; ?>
<br>
<a href="/links/add">Добавить ссылку</a>

<?php if(isset($status)) : ?>
    <p>Статус: </p><?=$status?>
<?php endif; ?>

<?php init_footer(); ?>
