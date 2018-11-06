<?php init_header($title); ?>
    <form method="POST">
        <input type="text" name="login">
        <label for="login">Логин</label>
        <input type="password" name="password">
        <label for="password">Пароль</label>
        <input type="text" name="password_repeat">
        <label for="password_repeat">Повторите пароль</label>
        <input type="email" name="email">
        <label for="email">Email</label>
        <input type="text" name="name">
        <label for="name">Имя</label>
        <input type="text" name="surname">
        <label for="surname">Фамилия</label>
        <input type="submit">
    </form>
<?php init_footer(); ?>