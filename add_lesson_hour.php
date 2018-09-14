<?php

require_once __DIR__ . '/vendor/autoload.php';


$ary = array();
$key = array(
    'id',
    'faculty_id',
    'sub_title',
    'subsub_title',
    'lesson_title',
    'lesson_term',
    'lesson_date',
    'lesson_hour',
    'lesson_credit',
    'lesson_professor',
    'lesson_objectives',
    'lesson_content',
    'lesson_style',
    'lesson_evaluation',
    'lesson_textbook',
    'lesson_read',
    'lesson_officehour',
    'lesson_info',
    'evaluate_exam',
    'evaluate_report',
    'evaluate_mintest',
    'evaluate_apply',
    'evaluate_others',
    'evaluate_total',
    'url',
    'year',
);




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


for ($i=0; $i < count($csv); $i++) {
  $ary2 = array();

  if(strpos($csv[$i + 1][6],'月') !== false){
    $hour = explode('月', $csv[$i + 1][6]);
    $date = '月';

  } elseif (strpos($csv[$i + 1][6],'火') !== false) {
    $hour = explode('火', $csv[$i + 1][6]);
    $date = '火';

  } elseif (strpos($csv[$i + 1][6],'水') !== false) {
    $hour = explode('水', $csv[$i + 1][6]);
    $date = '水';

  } elseif (strpos($csv[$i + 1][6],'木') !== false) {
    $hour = explode('木', $csv[$i + 1][6]);
    $date = '木';

  } elseif (strpos($csv[$i + 1][6],'金') !== false) {
    $hour = explode('金', $csv[$i + 1][6]);
    $date = '金';

  } elseif (strpos($csv[$i + 1][6],'土') !== false) {
    $hour = explode('土', $csv[$i + 1][6]);
    $date = '土';

  }


  $ary2[$i][0] = $csv[$i + 1][0];
  $ary2[$i][1] = $csv[$i + 1][1];
  $ary2[$i][2] = $csv[$i + 1][2];
  $ary2[$i][3] = $csv[$i + 1][3];
  $ary2[$i][4] = $csv[$i + 1][4];
  $ary2[$i][5] = $csv[$i + 1][5];
  $ary2[$i][6] = $date;
  $ary2[$i][7] = $hour[1];
  $ary2[$i][8] = $csv[$i + 1][7];
  $ary2[$i][9] = $csv[$i + 1][8];
  $ary2[$i][10] = $csv[$i + 1][9];
  $ary2[$i][11] = $csv[$i + 1][10];
  $ary2[$i][12] = $csv[$i + 1][11];
  $ary2[$i][13] = $csv[$i + 1][12];
  $ary2[$i][14] = $csv[$i + 1][13];
  $ary2[$i][15] = $csv[$i + 1][14];
  $ary2[$i][16] = $csv[$i + 1][15];
  $ary2[$i][17] = $csv[$i + 1][16];
  $ary2[$i][18] = $csv[$i + 1][17];
  $ary2[$i][19] = $csv[$i + 1][18];
  $ary2[$i][20] = $csv[$i + 1][19];
  $ary2[$i][21] = $csv[$i + 1][20];
  $ary2[$i][22] = $csv[$i + 1][21];
  $ary2[$i][23] = $csv[$i + 1][22];
  $ary2[$i][24] = $csv[$i + 1][23];
  $ary2[$i][25] = $csv[$i + 1][24];
  $ary2[$i][26] = $csv[$i + 1][25];


  // $ary[0] = $key;

  // $ary[$i + 1] = $ary2;


  $f = fopen("lesson_data3.csv", "a");
  // 正常にファイルを開くことができていれば、書き込みます。
  if ( $f ) {
    // $ary から順番に配列を呼び出して書き込みます。
    foreach($ary2 as $line){
      // fputcsv関数でファイルに書き込みます。
      fputcsv($f, $line);
    }
  }
  // ファイルを閉じます。
  fclose($f);


}






