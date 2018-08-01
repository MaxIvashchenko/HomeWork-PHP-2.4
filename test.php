<?php
require_once 'core/functions.php';
emptyUser(true);

if (!empty($_GET["name"])) {
	$path = './tests/'.$_GET['name'];
		if (file_exists($path)) {
			$tests = file_get_contents($path);
			$tests = json_decode($tests,true);
		} else {
			header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found'); 
			die('404 Not Found');
		}
}
$_SESSION['tests'] = $tests;
$ok = [];
$notok = [];
if (!empty($_POST)) {
	foreach ($_POST as $post_key => $post_value) {
		foreach ($_SESSION['tests'] as $test) {
			if ($post_key == $test['title'] && $post_value == $test['correct']) {
				$ok[] = $test['title'];
			} 
			elseif ($post_key == $test['title'] && $post_value !== $test['correct']) {
				$notok[] = $test['title'];
			}
		}
	}
}
if(!empty($_POST['testname'])) {
	
	$testname = trim($_POST['testname']);
	$testname = strip_tags($testname);
	$testname = htmlspecialchars($testname,ENT_QUOTES);
	$testname = stripslashes($testname);
}
$result = count($ok).' из '.count($_SESSION['tests']);
?>

<!DOCTYPE html>
<html lang="ru">
<html>
<head>
	<meta charset="utf-8">
	 <title>Домашнее задание к лекции 2.4</title>
</head>
<html>
<body>
	<h3>Пройди тест</h3>
	<form action="" method="POST">
	<?php  foreach ($tests as $test) {?>
		
		<fieldset>
		<legend><?= $test['question'];?></legend>
		<?php foreach ($test['answers'] as $key => $answer ){ ?>
			<label><input type="radio" name="<?= $test['title'];?>" value="<?= $key;?>"><?= $answer['variant']; ?></label>
		<?php } ?>
		</fieldset>

		<?php } ?>	
		<br>
		
		<input type="hidden" name="testname" value="<?php echo(stristr($_GET['name'],'.',true)) ?>">
		<input type="submit" name="send" value="Отправить">
	</form>
	<?php if(isset($_POST["send"])) { ?>
	<h3>Ваш результат: </h3>
	<?php echo "Верных ответов " . count($ok) . " из ". count($_SESSION['tests']);} ?>
	<?php foreach ($ok as $rightAnsw) { ?>
		<p>Верно: <?= $rightAnsw; ?></p>
	<?php } ?>
	<?php foreach ($notok as $notrightAnsw) { ?>
		<p>Неверно: <?= $notrightAnsw;?> </p>
	<?php } ?>
<?php if(isset($_POST["send"])) { ?>
<p><a href="core/certificate.php?testname=<?php echo($testname)?>&result=<?php echo($result) ?>">Загрузить сертификат</a></p>
<?php } ?>
<br><br>
	<p><a href="admin.php">Вернуться к добавлению теста</a></p>
	<p><a href="index.php">На главную</a></p>
</body>
</html>