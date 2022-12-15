<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録画面</title>
</head>

<body>
  <!-- <form action="create.php" method="POST"> -->
  <h1>ボクの考えた最強のポケモン</h1>
  <h3>ルール</h3>
  <p>・能力値の合計が600以下になるように設定すること</p>
  <p>・ワザの威力は2種類合計で200以下になるようにすること</p>
  <p>・どれだけ弱いボケモンで難しいの敵に勝てるかな！</p>
  <p>・最大ダメージをだせる能力値の組合せも考えてみよう！</p>
  <form action="post.php" method="POST">
    <fieldset>
      <legend>ボケモン登録画面</legend>
      <div>
        ボケモン名: <input type="text" name="bokemon_name" value="ボケルドン">
      </div>
      <div>
        ボケモンタイプ：
        &nbsp; 炎<input type="radio" name="bokemon_type" value="0">
        &nbsp; 水<input type="radio" name="bokemon_type" value="1">
        &nbsp; 電<input type="radio" name="bokemon_type" value="2">
        &nbsp; 草<input type="radio" name="bokemon_type" value="3">
        &nbsp; 氷<input type="radio" name="bokemon_type" value="4">
        &nbsp; 闘<input type="radio" name="bokemon_type" value="5">
        &nbsp; 毒<input type="radio" name="bokemon_type" value="6">
        &nbsp; 地<input type="radio" name="bokemon_type" value="7">
        &nbsp; 飛<input type="radio" name="bokemon_type" value="8">
        &nbsp; 超<input type="radio" name="bokemon_type" value="9">
        &nbsp; 虫<input type="radio" name="bokemon_type" value="10" checked>
        &nbsp; 岩<input type="radio" name="bokemon_type" value="11">
        &nbsp; 霊<input type="radio" name="bokemon_type" value="12">
        &nbsp; 竜<input type="radio" name="bokemon_type" value="13">
        &nbsp; 悪<input type="radio" name="bokemon_type" value="14">
        &nbsp; 鋼<input type="radio" name="bokemon_type" value="15">
        &nbsp; 妖<input type="radio" name="bokemon_type" value="16">
      </div>
      <div>
        HP: <input type="text" name="hitpoint" value="100">
        攻撃: <input type="text" name="attack" value="100">
        防御: <input type="text" name="block" value="100">
        特攻: <input type="text" name="contact" value="100">
        特防: <input type="text" name="diffence" value="100">
        素早: <input type="text" name="speed" value="100">
      </div>
    </fieldset>
    <fieldset>
      <legend>ワザ１登録画面</legend>
      <div>
        ワザ名: <input type="text" name="move1" value="パンチ">
      </div>
      <div>
        ワザタイプ：
        &nbsp; 炎<input type="radio" name="move1_type" value="0">
        &nbsp; 水<input type="radio" name="move1_type" value="1">
        &nbsp; 電<input type="radio" name="move1_type" value="2">
        &nbsp; 草<input type="radio" name="move1_type" value="3">
        &nbsp; 氷<input type="radio" name="move1_type" value="4">
        &nbsp; 闘<input type="radio" name="move1_type" value="5" checked>
        &nbsp; 毒<input type="radio" name="move1_type" value="6">
        &nbsp; 地<input type="radio" name="move1_type" value="7">
        &nbsp; 飛<input type="radio" name="move1_type" value="8">
        &nbsp; 超<input type="radio" name="move1_type" value="9">
        &nbsp; 虫<input type="radio" name="move1_type" value="10">
        &nbsp; 岩<input type="radio" name="move1_type" value="11">
        &nbsp; 霊<input type="radio" name="move1_type" value="12">
        &nbsp; 竜<input type="radio" name="move1_type" value="13">
        &nbsp; 悪<input type="radio" name="move1_type" value="14">
        &nbsp; 鋼<input type="radio" name="move1_type" value="15">
        &nbsp; 妖<input type="radio" name="move1_type" value="16">
      </div>
      <div>
        攻撃方法：
        物理<input type="radio" name="move1_method" value="0" checked>
        &nbsp; 特殊<input type="radio" name="move1_method" value="2">
      </div>
      <div>
        威力: <input type="text" name="move1_power" value="50">
      </div>
    </fieldset>
    <fieldset>
      <legend>ワザ２登録画面</legend>
      <div>
        ワザ名: <input type="text" name="move2" value="暗黒超雷双拳">
      </div>
      <div>
        ワザタイプ：
        &nbsp; 炎<input type="radio" name="move2_type" value="0">
        &nbsp; 水<input type="radio" name="move2_type" value="1">
        &nbsp; 電<input type="radio" name="move2_type" value="2">
        &nbsp; 草<input type="radio" name="move2_type" value="3">
        &nbsp; 氷<input type="radio" name="move2_type" value="4">
        &nbsp; 闘<input type="radio" name="move2_type" value="5">
        &nbsp; 毒<input type="radio" name="move2_type" value="6">
        &nbsp; 地<input type="radio" name="move2_type" value="7">
        &nbsp; 飛<input type="radio" name="move2_type" value="8">
        &nbsp; 超<input type="radio" name="move2_type" value="9">
        &nbsp; 虫<input type="radio" name="move2_type" value="10" checked>
        &nbsp; 岩<input type="radio" name="move2_type" value="11">
        &nbsp; 霊<input type="radio" name="move2_type" value="12">
        &nbsp; 竜<input type="radio" name="move2_type" value="13">
        &nbsp; 悪<input type="radio" name="move2_type" value="14">
        &nbsp; 鋼<input type="radio" name="move2_type" value="15">
        &nbsp; 妖<input type="radio" name="move2_type" value="16">
      </div>
      <div>
        攻撃方法：
        物理<input type="radio" name="move2_method" value="0" checked>
        &nbsp; 特殊<input type="radio" name="move2_method" value="2">
      </div>
      <div>
        威力: <input type="text" name="move2_power" value="150">
      </div>
    </fieldset>
    <fieldset>
      <legend>難易度選択画面</legend>
      <div>
        &nbsp; 簡単<input type="radio" name="select" value="0">
        &nbsp; 普通<input type="radio" name="select" value="3">
        &nbsp; 難しい<input type="radio" name="select" value="6">
        &nbsp; 無理ゲー<input type="radio" name="select" value="9">
      </div>
    </fieldset>
    <button>このボケモンで戦う</button>
    <!-- <a href="read.php">一覧画面</a> -->
  </form>
</body>

</html>