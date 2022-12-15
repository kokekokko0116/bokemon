<?php

$bokemon_name = $_POST["bokemon_name"];
$bokemon_type = $_POST["bokemon_type"];
$bokemon_status =[
  $_POST["hitpoint"],
  $_POST["attack"],
  $_POST["block"],
  $_POST["contact"],
  $_POST["diffence"],
  $_POST["speed"]
];

$move1 =[
  $_POST["move1"],
  $_POST["move1_type"],
  $_POST["move1_method"],
  $_POST["move1_power"]
];

$move2 =[
  $_POST["move2"],
  $_POST["move2_type"],
  $_POST["move2_method"],
  $_POST["move2_power"]
];

$write_data_bokemon = "名前:$bokemon_name タイプ:$bokemon_type HP:$bokemon_status[0] 攻撃:$bokemon_status[1] 防御:$bokemon_status[2] 特攻:$bokemon_status[3] 特防:$bokemon_status[4] 素早:$bokemon_status[5]\n";

$write_data_move1 = "ワザ名:$move1[0] タイプ:$move1[1] 分類:$move1[2] 威力:$move1[3]\n";
$write_data_move2 = "ワザ名:$move2[0] タイプ:$move2[1] 分類:$move2[2] 威力:$move2[3]\n";

$file = fopen("data/bokemon.txt","w");

flock($file, LOCK_EX);

fwrite($file, $write_data_bokemon);
fwrite($file, $write_data_move1);
fwrite($file, $write_data_move2);

flock($file,LOCK_UN);
fclose($file);

header("Location:index.php");