<?php
// require_once __DIR__ . '/vendor/autoload.php';
// require('index.php');


function createRoundData($crawler, $lesson_id) {
  $data = array();

  $text = $crawler->filter('#pnlContent')->text();



  $lesson_title = $crawler->filter('#pnlContent tr .tbl-item-w-strong')->text();
  $lesson_title = str_replace('　≪◇学部≫', '', $lesson_title);


  if(strpos($text,'授業計画表')) {
    $rounds = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(5)->filter('table tr:nth-child(2) table tbody tr:nth-child(n+1) td:nth-child(1)');
    $round = array();
    foreach ($rounds as $v) {
      $t = trim($v->textContent);
      $round[] = $t;
    }


    $titles = $crawler->filter('#pnlContent tr .tbl-item-w')->eq(5)->filter('table tr:nth-child(2) table tbody tr:nth-child(n+1) td:nth-child(2)');
    $title = array();
    foreach ($titles as $v) {
      $t = trim($v->textContent);
      $title[] = $t;
    }

    $round_data = array();
    for ($i=0; $i < count($round); $i++) {

      // $id                  = $id**;
      $lesson_id           = $lesson_id;
      $lesson_title        = $lesson_title;
      $lesson_round        = $round[$i];
      $lesson_round_title  = $title[$i];

      // $ary2 = array($id, $lesson_id, $lesson_title, $lesson_round, $lesson_round_title);
      $ary2 = array($lesson_id, $lesson_title, $lesson_round, $lesson_round_title);
      array_push($round_data, $ary2);
    }


  }
  // else {

  //     $id                  = '';
  //     $lesson_id           = $lesson_id;
  //     $lesson_title        = $lesson_title;
  //     $lesson_round        = '';
  //     $lesson_round_title  = '';

  //     $round_data = array();
  //     $ary2 = array($id, $lesson_id, $lesson_title, $lesson_round, $lesson_round_title);
  //     array_push($round_data, $ary2);


  // }

  return $round_data;
}
