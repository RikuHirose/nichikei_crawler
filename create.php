<?php
require_once __DIR__ . '/vendor/autoload.php';
// require('index.php');


function createData($crawler, $url) {
  $data = array();

  $lesson_id = $i + 1;

  $faculty_id = 1;

  $sub_title = 

  $subsub_title = 

  $lesson_title = $crawler->filter('#pnlContent tr .tbl-item-w-strong')->text();
  $lesson_title = str_replace('　≪◇学部≫', '', $lesson_title);



  $lesson_term = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(0)->text();

  $lesson_date = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(1)->text();

  $lesson_credit = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(2)->text();

  $lesson_professor = $crawler->filter('#pnlKogiKyoin tr .group-base-main td')->eq(2)->text();

  $lesson_objectives = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(3)->text();


  $lesson_content = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(4)->text();

  $lesson_style = $crawler->filter('#pnlContent table')->filter('#trJugyoKeishikiLine + tr .tbl-item-w')->text();



  $texts = $crawler->filter('#pnlContent table')->eq(4)->filter('table tr:nth-child(n+3) .tbl-head');

  $text = '';
  foreach ($texts as $v) {
    $t = trim($v->textContent);
    $text =  $text. $t;
  }


  if(strpos($text,'評価の特記事項')) {
    $lesson_evaluation = $crawler->filter('#pnlContent table')->filter('#trTokkiJikoLine + tr .tbl-item-w')->text();
  } else {
    $lesson_evaluation = '';
  }



  if(strpos($text,'テキスト')) {
    $lesson_textbook = $crawler->filter('#pnlContent table')->filter('#trTextCusLine + tr .tbl-item-w')->text();
  } else {
    $lesson_textbook = '';
  }


  if(strpos($text,'参考文献')) {
    $lesson_read = $crawler->filter('#pnlContent table')->filter('#trSankoBunkenCusLine + tr .tbl-item-w')->text();
  } else {
    $lesson_read = '';
  }

  if(strpos($text,'オフィスアワー(授業相談)')) {
    $lesson_officehour = $crawler->filter('#pnlContent table')->filter('#trOfficeHourLine + tr .tbl-item-w')->text();
  } else {
    $lesson_officehour = '';
  }

  if(strpos($text,'事前学習の内容など，学生へのメッセージ')) {
    $lesson_info = $crawler->filter('#pnlContent table')->filter('#trGakuseiMessageLine + tr .tbl-item-w')->text();
  } else {
    $lesson_info = '';
  }

  $year = 2018;

  $data = [
    'lesson_id'         => $lesson_id,
    'faculty_id'        => $faculty_id,
    'sub_title'         => $sub_title,
    'subsub_title'      => $subsub_title,
    'lesson_title'      => $lesson_title,
    'lesson_term'       => $lesson_term,
    'lesson_date'       => $lesson_date,
    'lesson_credit'     => $lesson_credit,
    'lesson_professor'  => $lesson_professor,
    'lesson_objectives' => $lesson_objectives,
    'lesson_content'    => $lesson_content,
    'lesson_style'      => $lesson_style,
    'lesson_evaluation' => $lesson_evaluation,
    'lesson_textbook'   => $lesson_textbook,
    'lesson_read'       => $lesson_read,
    'lesson_officehour' => $lesson_officehour,
    'lesson_info'       => $lesson_info,
    'url'               => $url,
    'year'              => $year,
  ];


  return $data;
}

