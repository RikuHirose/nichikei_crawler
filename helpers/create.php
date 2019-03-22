<?php
// require_once __DIR__ . '/vendor/autoload.php';
// require('index.php');


function createData($subtitle, $subsubtitle, $url, $crawler, $id) {
  $data = array();
  $texts = $crawler->filter('#pnlContent table')->eq(4)->filter('table tr:nth-child(n+3) .tbl-head');

  $text = '';
  foreach ($texts as $v) {
    $t = trim($v->textContent);
    $text =  $text. $t;
  }

  $lesson_id = $id;

  $faculty_id = 1;

  $sub_title = $subtitle;

  if($sub_title == '保健体育科目' || $sub_title == '専門教育科目' || $sub_title == '教職課程科目') {
    $subsub_title = '';
  } else {
    $subsub_title = $subsubtitle;
  }

  $lesson_title = $crawler->filter('#pnlContent tr .tbl-item-w-strong')->text();
  $lesson_title = str_replace('　≪◇学部≫', '', $lesson_title);



  $lesson_term = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(0)->text();

  $date = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(1)->text();


  if(strpos($date, '月') !== false){
    $hour = explode('月', $date);
    $lesson_hour = $hour[1];
    $lesson_date = '月';

  } elseif (strpos($date, '火') !== false) {
    $hour = explode('火', $date);
    $lesson_hour = $hour[1];
    $lesson_date = '火';

  } elseif (strpos($date, '水') !== false) {
    $hour = explode('水', $date);
    $lesson_hour = $hour[1];
    $lesson_date = '水';

  } elseif (strpos($date, '木') !== false) {
    $hour = explode('木', $date);
    $lesson_hour = $hour[1];
    $lesson_date = '木';

  } elseif (strpos($date, '金') !== false) {
    $hour = explode('金', $date);
    $lesson_hour = $hour[1];
    $lesson_date = '金';

  } elseif (strpos($date, '土') !== false) {
    $hour = explode('土', $date);
    $lesson_hour = $hour[1];
    $lesson_date = '土';

  }


  $lesson_credit = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(2)->text();

  $lesson_professor = $crawler->filter('#pnlKogiKyoin tr .group-base-main td')->eq(2)->text();

  $lesson_objectives = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(3)->text();


  $lesson_content = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(4)->text();


  if(strpos($text,'授業形式')) {
    $lesson_style = $crawler->filter('#pnlContent table')->filter('#trJugyoKeishikiLine + tr .tbl-item-w')->text();
  } else {
    $lesson_style = '';
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



  if(strpos($text,'評価方法')) {
    $evaluate_exam     = $crawler->filter('#pnlContent table')->filter('#trHyokaHohoCusLine + tr .tbl-item-w table table tr:nth-child(2) td:nth-child(1)')->text();
    $evaluate_report   = $crawler->filter('#pnlContent table')->filter('#trHyokaHohoCusLine + tr .tbl-item-w table table tr:nth-child(2) td:nth-child(2)')->text();
    $evaluate_mintest  = $crawler->filter('#pnlContent table')->filter('#trHyokaHohoCusLine + tr .tbl-item-w table table tr:nth-child(2) td:nth-child(3)')->text();
    $evaluate_apply    = $crawler->filter('#pnlContent table')->filter('#trHyokaHohoCusLine + tr .tbl-item-w table table tr:nth-child(2) td:nth-child(4)')->text();
    $evaluate_others   = $crawler->filter('#pnlContent table')->filter('#trHyokaHohoCusLine + tr .tbl-item-w table table tr:nth-child(2) td:nth-child(5)')->text();
    $evaluate_total    = $crawler->filter('#pnlContent table')->filter('#trHyokaHohoCusLine + tr .tbl-item-w table table tr:nth-child(2) td:nth-child(6)')->text();
  } else {
    $evaluate_exam     = '';
    $evaluate_report   = '';
    $evaluate_mintest  = '';
    $evaluate_apply    = '';
    $evaluate_others   = '';
    $evaluate_total    = '';
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
    'lesson_hour'       => $lesson_hour,
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
    'evaluate_exam'     => $evaluate_exam,
    'evaluate_report'   => $evaluate_report,
    'evaluate_mintest'  => $evaluate_mintest,
    'evaluate_apply'    => $evaluate_apply,
    'evaluate_others'   => $evaluate_others,
    'evaluate_total'    => $evaluate_total,
    'url'               => $url,
    'year'              => $year,
  ];

  return $data;
}

