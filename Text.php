<?php
require_once __DIR__ . '/vendor/autoload.php';


$ary = array();
$key = array(
  'id',
  'lesson_id',
  'lesson_title',
  'amazon_url',
  'yomereba_html'
);


$cli = new Goutte\Client();

//file
$file = array();
foreach(glob('/Users/rikuparkour1996/www/scraping/lesson_data/lesson_data.csv') as $f){
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


for ($v=0; $v < count($csv); $v++) {
  $id = $v + 1;

  $ary2 = array();
  $ary = [];

  $ary2[] = $id;
  $ary2[] = $csv[$v][0];
  $ary2[] = $csv[$v][1];
  $ary2[] = $csv[$v][2];
  $ary2[] = $csv[$v][3];


  $ary[$v] = $ary2;


  $f = fopen("lesson_data/lesson_roundid.csv", "a");
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






