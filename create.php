<?php


// function create() {
//   $lesson_title = $crawler->filter('#pnlContent tr .tbl-item-w-strong')->text();
//   $lesson_title = str_replace('　≪◇学部≫', '', $lesson_title);
//   $ary2[] = $lesson_title;


//   $lesson_term = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(0)->text();
//   $ary2[] = $lesson_term;

//   $lesson_date = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(1)->text();
//   $ary2[] = $lesson_date;

//   $lesson_credit = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(2)->text();
//   $ary2[] = $lesson_credit;

//   $lesson_professor = $crawler->filter('#pnlKogiKyoin tr .group-base-main td')->eq(2)->text();
//   $ary2[] = $lesson_professor;

//   $lesson_objectives = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(3)->text();
//   $ary2[] = $lesson_objectives;


//   $lesson_content = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(4)->text();
//   $ary2[] = $lesson_content;

//   $lesson_style = $crawler->filter('#pnlContent table')->eq(4)->filter('.tbl-item-w')->eq(5)->text();
//   $ary2[] = $lesson_style;



//   $text = $crawler->filter('#pnlContent table')->eq(4)->text();

//   // $text = $crawler->filter('#pnlContent table')->eq(4)->filter('#trJugyoKeishikiLine ~ tr')->text();
//   //?? id trJugyoKeishikiLine以降のtr要素を全て取得したい


//   if(strpos($text,'評価の特記事項')) {
//     $lesson_evaluation = $crawler->filter('#pnlContent table')->filter('#trTokkiJikoLine + tr .tbl-item-w')->text();
//   } else {
//     $lesson_evaluation = '';
//   }

//   $ary2[] = $lesson_evaluation;



//   if(strpos($text,'テキスト')) {
//     $lesson_textbook = $crawler->filter('#pnlContent table')->filter('#trTextCusLine + tr .tbl-item-w')->text();
//   } else {
//     $lesson_textbook = '';
//   }

//   $ary2[] = $lesson_textbook;


//   if(strpos($text,'参考文献')) {
//     $lesson_read = $crawler->filter('#pnlContent table')->filter('#trSankoBunkenCusLine + tr .tbl-item-w')->text();
//   } else {
//     $lesson_read = '';
//   }
//   $ary2[] = $lesson_read;


//   $lesson_officehour = $crawler->filter('#pnlContent table')->filter('#trOfficeHourLine + tr .tbl-item-w')->text();
//   $ary2[] = $lesson_officehour;


//   $lesson_info = $crawler->filter('#pnlContent table')->filter('#trGakuseiMessageLine + tr .tbl-item-w')->text();
//   $ary2[] = $lesson_info;


//   $ary2[] = $url;

//   $year = 2018;
//   $ary2[] = $year;
// }