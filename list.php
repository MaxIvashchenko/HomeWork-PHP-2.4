<?php
require_once 'core/functions.php';
emptyUser(true);
$direction  = 'tests';
if(is_dir($direction)) { 
	$files = scandir($direction); 
	array_shift($files);
	array_shift($files);
	} 

foreach($files as $file) {
	if (file_exists($direction.'/'.$file)) {
		if (isset($_GET['delete'])) {
			unlink($direction.'/'.$_GET['delete']);
		}
	}
	break;
}
?>

<!DOCTYPE html>
<html lang="ru">
<html>
<head>
	<meta charset="utf-8">
	<title>Домашнее задание к лекции 2.2</title>
</head>
<body>

<h1>Добро пожаловать<?php echo whoUR ($_SESSION) ?>!</h1>
	<h2>Выберите тест:</h2>
	<?php for($i=0; $i<sizeof($files); $i++) { 
    if (file_exists($direction.'/'.$files[$i])) { ?>
	<p><a href="test.php?name=<?php echo $files[$i]; ?>" title="перейти к тесту"><?php echo $files[$i]; ?></a></p>
<?php if (!empty($_SESSION['user'])) : ?>
			<p><a href="list.php?delete=<?php echo $files[$i]; ?>">Удалить тест</a></p>
		<?php endif; ?>

	<?php }} ?>
<br><br><br>

	<?php if (!empty($_SESSION['user'])) : ?>
<p><a href="admin.php">Вернуться к добавлению</a></p>
	<?php endif; ?>

<p><a href="core/logout.php">Выход</a></p>
</body>
</html>
