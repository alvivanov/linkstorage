<?php init_header($title); ?>

    <form method="post" action="/links/do_action">
        <label for="title">Название</label>
        <input type="text" name="title" value="<?php echo isset($link['title']) ? $link['title'] : ''; ?>" <?=$disabled?>>
        <label for="link">Ссылка</label>
        <input type="text" name="link" value="<?php echo isset($link['link']) ? $link['link'] : ''; ?>" <?=$disabled?>>
        <label for="description">Описание</label>
        <textarea name="description" <?=$disabled?>><?php echo isset($link['description']) ? $link['description'] : ''; ?></textarea>
        <label for="private">Приватность</label>
        <input type="checkbox" name="private" <?php echo (isset($link['private']) && $link['private'] == 1) ? 'checked' : ''; ?> <?=$disabled?>>
        <input type="hidden" name="action" value="<?php echo isset($action) ? $action : ''; ?>">
        <input type="hidden" name="id" value="<?php echo isset($link['id']) ? $link['id'] : ''; ?>">
        <br>
        <button type="submit"><?=$button_name?></button>
    </form>

<?php if(isset($status)) : ?>
    <br>
    <p>Статус: </p><?=$status?>
<?php endif; ?>


<?php init_footer(); ?>