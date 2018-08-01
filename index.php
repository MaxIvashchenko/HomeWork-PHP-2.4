<?php
require_once 'core/functions.php';
$errors = [];
if (!empty($_POST)) {
	if (login($_POST['login'], $_POST['password'])) {
	   header('Location: list.php');
	   die;
	} else {
		$errors[] = 'Неверный логин или пароль';
	}
}
if (!empty($_POST['for_guest'])) {
		if (guest($_POST['login'])) {
            header('Location: list.php');
            die;
		}
}
?>

<!DOCTYPE html>
<html>
<head>
	 <title>Домашнее задание к лекции 2.4</title>
	<meta charset="utf-8">
</head>
<body>
	<h2>Добро пожаловать<?php whoUR() ?>!</h2>
	<h3>Главная страница</h3>
	 <?php if (empty($_SESSION)) { ?>
	 <h4>Авторизация</h4>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <form action= "" method="POST">
                <div class="form-group">
                    <label for="lg" class="">Логин</label>
                    <input type="text" required placeholder="Логин" name="login">
                </div>
                <div class="form-group">
                    <label for="key">Пароль</label>
                    <input type="password" placeholder="Пароль" name="password">
                </div>
                <input type="submit" value="Войти">
                 <input type="checkbox" name="for_guest" value="checked">
                        <label>Войти как гость</label>
                </form>
	<?php } else { ?>
	<h4>Вы уже вошли на сайт</h4>
	<p><a href="list.php">Назад к списку</a></p>
	<p><a href="core/logout.php">Выход</a></p>
	<?php } ?>

</body>
</html>