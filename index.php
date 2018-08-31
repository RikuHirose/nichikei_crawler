<?php

require_once __DIR__ . '/vendor/autoload.php';
require('urls.php');
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
    'url',
    'year',
);

$cli = new Goutte\Client();

// $urls
$num = count($urls);



for ($i=0; $i < $num; $i++) {
  $ary2 = array();

  $url = 'http://www.eco.nihon-u.ac.jp/about/disclosure/syllabus_2018/'.$urls[$i];
  $crawler = $cli->request('GET',$url);


  $data = createData($crawler, $url);


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
  $ary2[] = $data['url'];
  $ary2[] = $data['year'];

  $ary[0] = $key;
  $ary[$i + 1] = $ary2;


  usleep(500000);

}




$f = fopen("data.csv", "w");
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