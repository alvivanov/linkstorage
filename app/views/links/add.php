<?php init_header($title); ?>
    <form method="post" action="/links/insert_link">
        <label for="title">Название</label>
        <input type="text" name="title">
        <label for="link">Ссылка</label>
        <input type="text" name="link">
        <label for="description">Описание</label>
        <textarea name="description"></textarea>
        <label for="private">Приватность</label>
        <input type="checkbox" name="private">
        <br>
        <input type="submit">
    </form>
<?php init_footer(); ?>
