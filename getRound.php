<?php
require_once __DIR__ . '/vendor/autoload.php';
require('createRounds.php');

$ary = array();
$key = array(
  'id',
  'lesson_id',
  'lesson_title',
  'lesson_round',
  'lesson_round_title',
);


$cli = new Goutte\Client();

//file
$file = array();
foreach(glob('/Users/rikuparkour1996/www/scraping/urls/data.csv') as $f){
  if(is_file($f)){
    $f = htmlspecialchars($f);
    $file[] = $f;
  }
}


//csvを配列に変換
$csv  = array();
$fp   = fopen($file[0], "r");

while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
  $csv[] = $data;
}
fclose($fp);


for ($i=0; $i < count($csv); $i++) {

  //scrapingする
  $url = 'http://www.eco.nihon-u.ac.jp/about/disclosure/syllabus_2018/'.$csv[$i][2];
  // $url = 'http://www.eco.nihon-u.ac.jp/about/disclosure/syllabus_2018/2018_AB00002001.html';

  $crawler = $cli->request('GET',$url);
  $lesson_id = $i + 1250;

  if($data !== NULL) {
    $data = createRoundData($crawler, $lesson_id);

    for ($v=0; $v < count($data); $v++) {
      $ary2 = array();
      $ary = [];

      $ary2[] = $data[$v][0];
      $ary2[] = $data[$v][1];
      $ary2[] = $data[$v][2];
      $ary2[] = $data[$v][3];


      $ary[$v + 1] = $ary2;

      $f = fopen("lesson_data/lesson_rounds.csv", "a");
      // 正常にファイルを開くことができていれば、書き込みます。
      if ( $f ) {
        // $ary から順番に配列を呼び出して書き込みます。
        foreach($ary as $line){
          // fputcsv関数でファイルに書き込みます。
          fputcsv($f, $line);
        }
      }
      // ファイルを閉じます。
      fclose($f);

    }

  }

  sleep(5);

}






