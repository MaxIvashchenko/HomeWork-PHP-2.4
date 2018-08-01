<?php
require_once 'core/functions.php';
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

emptyUser();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Домашнее задание к лекции 2.4</title>
    <meta charset="UTF-8">
</head>
<body>
<form enctype="multipart/form-data" action="admin.php" method="post">
  <h2>Выберите файл</h2>
  <input type="file" name="testFile"><br><br>
  <input type="submit" value="Отправить тест">
</form>
<?php
if (!empty($_FILES["testFile"]["name"]))  {
    $filename=$_FILES["testFile"]["name"];
    $test_array=explode(".", $filename);
    
      if ($test_array[1] == "json")  
      {
        move_uploaded_file($_FILES["testFile"]["tmp_name"], "tests/" . $_FILES["testFile"]["name"]);
        echo "<i>Тест отправлен</i> <br><br>";
?>
       <form><input type="submit" formaction="list.php" value="Выбрать тест"><br><br></form>
<?php     
      }
    else
      {
        echo "<i>Ошибка</i>";
      }
  }
  else
      {
        echo "<i>Тест не загружен</i>";
      }
?>

<p><a href="index.php">На главную</a></p>
<p><a href="list.php">К списку тестов</a></p>
</body>
</html>