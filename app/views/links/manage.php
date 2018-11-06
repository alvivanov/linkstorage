<?php init_header($title); ?>

<form method="post" action="/links/do_action">
    <label for="title">Название</label>
    <input type="text" name="title" value="<?php echo isset($link['title']) ? $link['title'] : ''; ?>" <?=$disabled?>>
    <label for="link">Ссылка</label>
    <input type="text" name="link" value="<?php echo isset($link['link']) ? $link['link'] : ''; ?>" <?=$disabled?>>
    <label for="description">Описание</label>
    <textarea name="description" value="<?php echo isset($link['description']) ? $link['description'] : ''; ?>" <?=$disabled?>></textarea>
    <label for="private">Приватность</label>
    <input type="checkbox" name="private" <?php echo isset($link['private'])? 'checked' : ''; ?> <?=$disabled?>>
    <input type="hidden" name="action" value="<?php echo isset($action) ? $action : ''; ?>">
    <input type="hidden" name="id" value="<?php echo isset($link['id']) ? $link['id'] : ''; ?>">
    <br>
    <button type="submit"><?=$button_name?></button>
</form>

<?php init_footer(); ?>
