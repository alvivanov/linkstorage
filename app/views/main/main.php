<?php init_header($title); ?>
<table border="1">
    <thead>
        <th>Название</th>
        <th>Ссылка</th>
    </thead>
    <?php foreach($links as $link): ?>
        <tr>
            <td><?=$link['title']?></td>
            <td><a href="<?=$link['link']?>"><?=$link['link']?></a></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php init_footer(); ?>
