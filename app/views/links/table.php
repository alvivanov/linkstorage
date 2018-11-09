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
                <td><a class="title" href="/links/view/<?=$link['id']?>"><?=$link['title']?></a></td>
                <td><a class="link" href="<?=$link['url']?>" target="_blank"><?=$link['link']?></a></td>
                <td>
                    <a class="delete" id="<?=$link['id']?>">Delete</a>
                    <a class="edit" href="/links/edit/<?=$link['id']?>">Edit</a>
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
    <br><br>
    <?=$status?>
<?php endif; ?>


<script>
    $('.delete').on('click', function () {
        let a = confirm('Удалить ссылку "' + $(this).parents('tr').find('.title').text() + '"?');
        if(a) location.href = '/links/delete/' + $(this).attr('id');
    });
</script>
<?php init_footer(); ?>
