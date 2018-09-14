<?php

require_once __DIR__ . '/vendor/autoload.php';
require('create.php');

$ary = array();
$key = array(
    'id',
    'faculty_id',
    'sub_title',
    'subsub_title',
    'lesson_title',
    'lesson_term',
    'lesson_date',
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
  $ary2 = array();
  $ary = [];

  $subtitle = $csv[$i][0];
  $subsubtitle = $csv[$i][1];

  //scrapingする
  $url = 'http://www.eco.nihon-u.ac.jp/about/disclosure/syllabus_2018/'.$csv[$i][2];

  $crawler = $cli->request('GET',$url);
  $id = $i + 663;

  $data = createData($subtitle, $subsubtitle, $url, $crawler, $id);


  $ary2[] = $data['lesson_id'];
  $ary2[] = $data['faculty_id'];
  $ary2[] = $data['sub_title'];
  $ary2[] = $data['subsub_title'];
  $ary2[] = $data['lesson_title'];
  $ary2[] = $data['lesson_term'];
  $ary2[] = $data['lesson_date'];
  $ary2[] = $data['lesson_credit'];
  $ary2[] = $data['lesson_professor'];
  $ary2[] = $data['lesson_objectives'];
  $ary2[] = $data['lesson_content'];
  $ary2[] = $data['lesson_style'];
  $ary2[] = $data['lesson_evaluation'];
  $ary2[] = $data['lesson_textbook'];
  $ary2[] = $data['lesson_read'];
  $ary2[] = $data['lesson_officehour'];
  $ary2[] = $data['lesson_info'];
  $ary2[] = $data['evaluate_exam'];
  $ary2[] = $data['evaluate_report'];
  $ary2[] = $data['evaluate_mintest'];
  $ary2[] = $data['evaluate_apply'];
  $ary2[] = $data['evaluate_others'];
  $ary2[] = $data['evaluate_total'];
  $ary2[] = $data['url'];
  $ary2[] = $data['year'];

  // $ary[0] = $key;
  $ary[$i + 1] = $ary2;


  $f = fopen("lesson_data.csv", "a");
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

  sleep(5);

}






