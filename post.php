<?php

$type_list = ["炎", "水", "電", "草", "氷", "闘", "毒", "地", "飛", "超", "虫", "岩", "霊", "竜", "悪", "鋼", "妖"];
$method_list = ["物理", "", "特殊"]; // 0か2
$bokemon_name = $_POST["bokemon_name"];
$bokemon_type = $_POST["bokemon_type"];
$bokemon_status = [
  $_POST["hitpoint"],
  $_POST["attack"],
  $_POST["block"],
  $_POST["contact"],
  $_POST["diffence"],
  $_POST["speed"]
];

$move1 = [
  $_POST["move1"],
  $_POST["move1_type"],
  $_POST["move1_method"],
  $_POST["move1_power"]
];

$move2 = [
  $_POST["move2"],
  $_POST["move2_type"],
  $_POST["move2_method"],
  $_POST["move2_power"]
];

$data_txt = [
  fopen("data/easy/pochi.txt", "r"),
  fopen("data/easy/tama.txt", "r"),
  fopen("data/easy/pentan.txt", "r"),
  fopen("data/normal/butaman.txt", "r"),
  fopen("data/normal/carl.txt", "r"),
  fopen("data/normal/whip.txt", "r"),
  fopen("data/difficult/phantom.txt", "r"),
  fopen("data/difficult/pochirigesu.txt", "r"),
  fopen("data/difficult/zacian.txt", "r"),
  fopen("data/impossible/fire.txt", "r"),
  fopen("data/impossible/glass.txt", "r"),
  fopen("data/impossible/water.txt", "r"),
];
// txtを解析して敵のデータ作成。
$select = $_POST["select"];
$enemy_data = [];
$file = $data_txt[rand(0 + $select, 2 + $select)]; // この部分変更すれば敵を変えられます
flock($file, LOCK_EX);
if ($file) {
  while ($line = fgets($file)) {
    array_push($enemy_data, $line);
  }
}
flock($file, LOCK_UN);
fclose($file);

// jsに渡す用のデータ作成
$enemy_data_to_js = json_encode($enemy_data);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <!-- 敵の画面 -->
  <div>
    <div><?= $enemy_data[0] ?></div>
    <div><?= $type_list[(int)$enemy_data[1]] ?></div>
    <div>
      <div>HP:</div>
      <div id="enemy_hp_id"><?= $enemy_data[2] * 2 ?></div>
      <div><?= "攻撃:" . $enemy_data[3] ?></div>
      <div><?= "防御:" . $enemy_data[4] ?></div>
      <div><?= "特攻:" . $enemy_data[5] ?></div>
      <div><?= "特防:" . $enemy_data[6] ?></div>
      <div><?= "素早:" . $enemy_data[7] ?></div>
    </div>
    <button><?= $enemy_data[8] ?></button>
    <button><?= $enemy_data[12] ?></button>
  </div>

  <!-- プレイヤー画面 -->
  <div>
    <div><?= $bokemon_name ?></div>
    <div><?= $type_list[(int)$bokemon_type] ?></div>
    <div>
      <div>HP:</div>
      <div id="player_hp_id"><?= $bokemon_status[0] * 2 ?></div>
      <div><?= "攻撃:" . $bokemon_status[1] ?></div>
      <div><?= "防御:" . $bokemon_status[2] ?></div>
      <div><?= "特攻:" . $bokemon_status[3] ?></div>
      <div><?= "特防:" . $bokemon_status[4] ?></div>
      <div><?= "素早:" . $bokemon_status[5] ?></div>
    </div>
    <button id="move1_button"><?= $move1[0] ?></button>
    <button id="move2_button"><?= $move2[0] ?></button>
  </div>

  <div id="output">ここに表示されるよ</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    // htmlからのデータ変換
    const player_hp_id = document.getElementById("player_hp_id");
    const enemy_hp_id = document.getElementById("enemy_hp_id");
    const move1_button = document.getElementById("move1_button");
    const move2_button = document.getElementById("move2_button");
    const output = document.getElementById("output");

    // PHP → jsにデータ変換 プレイヤーデータ
    const player_type = Number(<?= json_encode($bokemon_type) ?>);
    const player_status_data = <?= json_encode($bokemon_status) ?>;
    const player_status = [
      Number(player_status_data[0]) * 2, // HP
      Number(player_status_data[1]), // 攻撃
      Number(player_status_data[2]), // 防御
      Number(player_status_data[3]), // 特攻
      Number(player_status_data[4]), // 特防
      Number(player_status_data[5]), // 素早
    ];
    const player_move_data1 = <?= json_encode($move1) ?>;
    const player_move_data2 = <?= json_encode($move2) ?>;
    const player_move = [
      [
        player_move_data1[0], // ワザ名
        Number(player_move_data1[1]), // タイプ
        Number(player_move_data1[2]), // 分類
        Number(player_move_data1[3]), // 威力
      ],
      [
        player_move_data2[0], // ワザ名
        Number(player_move_data2[1]), // タイプ
        Number(player_move_data2[2]), // 分類
        Number(player_move_data2[3]), // 威力
      ]
    ];

    // PHP → jsにデータ変換 敵データ
    const enemy_data = <?= json_encode($enemy_data) ?>;
    const enemy_type = Number(enemy_data[1].replace("\r\n", ""))
    const enemy_status = [
      Number(enemy_data[2].replace("\r\n", "")) * 2, // HP
      Number(enemy_data[3].replace("\r\n", "")), // 攻撃
      Number(enemy_data[4].replace("\r\n", "")), // 防御
      Number(enemy_data[5].replace("\r\n", "")), // 特攻
      Number(enemy_data[6].replace("\r\n", "")), // 特防
      Number(enemy_data[7].replace("\r\n", "")), // 素早
    ];
    const enemy_move = [
      [
        enemy_data[8].replace("\r\n", ""), // ワザ名
        Number(enemy_data[9].replace("\r\n", "")), // タイプ
        Number(enemy_data[10].replace("\r\n", "")), // 分類
        Number(enemy_data[11].replace("\r\n", "")), // 威力
      ],
      [
        enemy_data[12].replace("\r\n", ""), // ワザ名
        Number(enemy_data[13].replace("\r\n", "")), // タイプ
        Number(enemy_data[14].replace("\r\n", "")), // 分類
        Number(enemy_data[15].replace("\r\n", "")), // 威力
      ]
    ];

    // タイプ相性表
    const effective = [
      [0.5, 0.5, 1, 2, 2, 1, 1, 1, 1, 1, 2, 0.5, 1, 0.5, 1, 2, 1], // 炎
      [2, 0.5, 1, 0.5, 1, 1, 1, 2, 1, 1, 1, 2, 1, 0.5, 1, 1, 1], // 水
      [1, 2, 0.5, 0.5, 1, 1, 1, 0, 2, 1, 1, 1, 1, 0.5, 1, 1, 1], // 電
      [0.5, 2, 1, 0.5, 1, 1, 0.5, 2, 0.5, 1, 0.5, 2, 1, 0.5, 1, 0.5, 1], // 草
      [0.5, 0.5, 1, 2, 0.5, 1, 1, 2, 2, 1, 1, 1, 12, 1, 0.5, 1], // 氷
      [1, 1, 1, 1, 2, 1, 0.5, 1, 0.5, 0.5, 0.5, 2, 0, 1, 2, 2, 0.5], // 闘
      [1, 1, 1, 2, 1, 1, 0.5, 0.5, 1, 1, 1, 0.5, 0.5, 1, 1, 0, 2], // 毒
      [2, 1, 2, 0.5, 1, 1, 2, 1, 0, 1, 0.5, 2, 1, 1, 1, 2, 1], // 地
      [1, 1, 0.5, 2, 1, 2, 1, 1, 1, 1, 2, 0.5, 1, 1, 1, 0.5, 1], // 飛
      [1, 1, 1, 1, 1, 2, 2, 1, 1, 0.5, 1, 1, 1, 1, 0, 0.5, 1], // 超
      [0.5, 1, 1, 2, 1, 0.5, 0.5, 1, 0.5, 2, 1, 1, 0.5, 2, 1, 1, 0.5, 1, 2, 0.5, 0.5], // 虫
      [2, 1, 1, 1, 2, 0.5, 1, 0.5, 2, 1, 2, 1, 1, 1, 1, 0.5, 1], // 岩
      [1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 1, 2, 1, 0.5, 1, 1], // 霊
      [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 0.5, 0], // 竜
      [1, 1, 1, 1, 1, 0.5, 1, 1, 1, 2, 1, 1, 2, 1, 0.5, 1, 0.5], // 悪
      [0.5, 0.5, 0.5, 1, 2, 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 0.5, 2], // 鋼
      [0.5, 1, 1, 1, 1, 2, 0.5, 1, 1, 1, 1, 1, 1, 2, 2, 0.5], // 妖
    ];

    // 必要変数
    let player_hp = player_status[0];
    let enemy_hp = enemy_status[0];
    const victory = "君の勝利だ！";
    const lose = "君の負けだ、、、";



    //ダメージ計算式  (レベル * 2/5 +2) * 威力 * 攻撃 / 防御 / レベル * 相性  後に急所計算を行う
    const player_move1_damage = Math.floor(((50 * 2 / 5 + 2) * player_move[0][3] * player_status[1 + player_move[0][2]] / enemy_status[2 + player_move[0][2]]) / 50 * effective[player_move[0][1]][enemy_type]);
    const player_move2_damage = Math.floor(((50 * 2 / 5 + 2) * player_move[1][3] * player_status[1 + player_move[1][2]] / enemy_status[2 + player_move[1][2]]) / 50 * effective[player_move[1][1]][enemy_type]);
    const enemy_move1_damage = Math.floor(((50 * 2 / 5 + 2) * enemy_move[0][3] * enemy_status[1 + enemy_move[0][2]] / player_status[2 + enemy_move[0][2]]) / 50 * effective[enemy_move[0][1]][player_type]);
    const enemy_move2_damage = Math.floor(((50 * 2 / 5 + 2) * enemy_move[1][3] * enemy_status[1 + enemy_move[1][2]] / player_status[2 + enemy_move[1][2]]) / 50 * effective[enemy_move[1][1]][player_type]);

    // const player_move_damage = [player_move1_damage, player_move2_damage];
    const enemy_move_damage = [enemy_move1_damage, enemy_move2_damage];

    const critical = [1.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]; //急所16分の1

    // ボタンの挙動

    move1_button.addEventListener("click", () => {
      if (player_status[5] >= enemy_status[5]) { // プレイヤーのほうが早い場合
        const critical_num = Math.floor(Math.random() * 16);
        const move_num = Math.floor(Math.random() * 2);
        enemy_hp -= Math.floor(player_move1_damage * critical[critical_num]);
        $("#enemy_hp_id").text(enemy_hp);
        if (enemy_hp <= 0) {
          $("#output").text(victory);
        } else { // HPが0にならなかったら処理
          setTimeout(function() {
            player_hp -= Math.floor(enemy_move_damage[move_num] * critical[critical_num]);
            $("#player_hp_id").text(player_hp);
          }, 1000);
          if (player_hp <= 0) {
            $("#output").text(lose);
          }
        }
      } else { // 敵のほうが早い場合
        const critical_num = Math.floor(Math.random() * 16);
        const move_num = Math.floor(Math.random() * 2);
        player_hp -= Math.floor(enemy_move_damage[move_num] * critical[critical_num]);
        $("#player_hp_id").text(player_hp);
        if (player_hp <= 0) {
          $("#output").text(lose);
        } else {
          setTimeout(function() {
            enemy_hp -= Math.floor(player_move1_damage * critical[critical_num]);
            $("#enemy_hp_id").text(enemy_hp);
          }, 1000);
          if (enemy_hp <= 0) {
            $("#output").text(victory);
          }
        }
      }
    });
    move2_button.addEventListener("click", () => {
      if (player_status[5] >= enemy_status[5]) { // プレイヤーのほうが早い場合
        const critical_num = Math.floor(Math.random() * 16);
        const move_num = Math.floor(Math.random() * 2);
        enemy_hp -= Math.floor(player_move2_damage * critical[critical_num]);
        $("#enemy_hp_id").text(enemy_hp);
        if (enemy_hp <= 0) {
          $("#output").text(victory);
        } else {
          setTimeout(function() {
            player_hp -= Math.floor(enemy_move_damage[move_num] * critical[critical_num]);
            $("#player_hp_id").text(player_hp);
          }, 1000);
          if (player_hp <= 0) {
            $("#output").text(lose);
          }
        }
      } else { // 敵のほうが早い場合
        const critical_num = Math.floor(Math.random() * 16);
        const move_num = Math.floor(Math.random() * 2);
        player_hp -= Math.floor(enemy_move_damage[move_num] * critical[critical_num]);
        $("#player_hp_id").text(player_hp);
        if (player_hp <= 0) {
          $("#output").text(lose);
        } else {
          setTimeout(function() {
            enemy_hp -= Math.floor(player_move2_damage * critical[critical_num]);
            $("#enemy_hp_id").text(enemy_hp);
          }, 1000);
          if (enemy_hp <= 0) {
            $("#output").text(victory);
          }
        }
      }
    });




    // function damage() {
    //   (((30 * 2 / 5 + 2) * power * attack / block) / 50 + 2) * critical * type_match * effective
    // };
  </script>
</body>

</html>