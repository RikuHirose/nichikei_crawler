<?php

require_once __DIR__ . '/vendor/autoload.php';
require('urls.php');


$ary = array();
$key = array(
    'id',
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


  $lesson_id = $i + 1;
  $ary2[] = $lesson_id;

  $lesson_title = $crawler->filter('#pnlContent tr .tbl-item-w-strong')->text();
  $lesson_title = str_replace('　≪◇学部≫', '', $lesson_title);
  $ary2[] = $lesson_title;


  $lesson_term = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(0)->text();
  $ary2[] = $lesson_term;

  $lesson_date = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(1)->text();
  $ary2[] = $lesson_date;

  $lesson_credit = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(2)->text();
  $ary2[] = $lesson_credit;

  $lesson_professor = $crawler->filter('#pnlKogiKyoin tr .group-base-main td')->eq(2)->text();
  $ary2[] = $lesson_professor;

  $lesson_objectives = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(3)->text();
  $ary2[] = $lesson_objectives;


  $lesson_content = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(4)->text();
  $ary2[] = $lesson_content;

  $lesson_style = $crawler->filter('#pnlContent table')->filter('#trJugyoKeishikiLine + tr .tbl-item-w')->text();
  $ary2[] = $lesson_style;



  $texts = $crawler->filter('#pnlContent table')->eq(4)->filter('table tr:nth-child(n+3) .tbl-head');

  $text = '';
  foreach ($texts as $v) {
    $t = trim($v->textContent);
    $text =  $text. $t;
  }


  // $text = $crawler->filter('#pnlContent table')->eq(4)->filter('#trJugyoKeishikiLine ~ tr')->text();
  //?? id trJugyoKeishikiLine以降のtr要素を全て取得したい


  if(strpos($text,'評価の特記事項')) {
    $lesson_evaluation = $crawler->filter('#pnlContent table')->filter('#trTokkiJikoLine + tr .tbl-item-w')->text();
  } else {
    $lesson_evaluation = '';
  }
  $ary2[] = $lesson_evaluation;



  if(strpos($text,'テキスト')) {
    $lesson_textbook = $crawler->filter('#pnlContent table')->filter('#trTextCusLine + tr .tbl-item-w')->text();
  } else {
    $lesson_textbook = '';
  }
  $ary2[] = $lesson_textbook;


  if(strpos($text,'参考文献')) {
    $lesson_read = $crawler->filter('#pnlContent table')->filter('#trSankoBunkenCusLine + tr .tbl-item-w')->text();
  } else {
    $lesson_read = '';
  }
  $ary2[] = $lesson_read;

  if(strpos($text,'オフィスアワー(授業相談)')) {
    $lesson_officehour = $crawler->filter('#pnlContent table')->filter('#trOfficeHourLine + tr .tbl-item-w')->text();
  } else {
    $lesson_officehour = '';
  }
  $ary2[] = $lesson_officehour;

  if(strpos($text,'事前学習の内容など，学生へのメッセージ')) {
    $lesson_info = $crawler->filter('#pnlContent table')->filter('#trGakuseiMessageLine + tr .tbl-item-w')->text();
  } else {
    $lesson_info = '';
  }
  $ary2[] = $lesson_info;


  $ary2[] = $url;

  $year = 2018;
  $ary2[] = $year;


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