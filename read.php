<?php
$str = " ";

$file = fopen("data/bokemon.txt", "r");

flock($file, LOCK_EX);

if($file){
  while($line = fgets($file)){
    $str .="<tr><td>{$line}</td></tr>";
  }
}

flock($file, LOCK_UN);
fclose($file);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ボケモン確認画面</title>
</head>

<body>
  <fieldset>
    <legend>ボケモン確認画面</legend>
    <table>
      <thead>
        <tr>
          <th><?= $str ?></th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </fieldset>
  <a href="index.php">ボケモン登録画面</a>

  <script>
    const data= <?= json_encode($str) ?>;
    console.log(data);
  </script>
</body>

</html>