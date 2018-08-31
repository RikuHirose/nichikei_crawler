<?php

require_once __DIR__ . '/vendor/autoload.php';

$cli = new Goutte\Client();


$object_url = 'http://www.eco.nihon-u.ac.jp/about/disclosure/syllabus_2018/gakubu.html';
$crawler = $cli->request('GET',$object_url);

// url リスト取得
$links = $crawler->filter('#main .section .sideList li a')->extract('href');

$urls = array();
$key = array(
  'subtitle',
  'subsubtitle',
  'url',
);


$n = count($links);
// $urls[0] = $key;

for ($i=0; $i < $n; $i++) {


  $link = 'http://www.eco.nihon-u.ac.jp/about/disclosure/syllabus_2018/'.$links[$i];

  

  // $link = 'http://www.eco.nihon-u.ac.jp/about/disclosure/syllabus_2018/AA00001.html';
  $crawler = $cli->request('GET',$link);


  // $found_url = $crawler->filter('#main .teachersList li a')->extract('href');

  $found_url = $crawler->filter('#main .teachersList li a')->each(function($v){
    return $v->extract('href');
  });



  $title = $crawler->filter('#main .subTitle h2')->text();
  $title = explode('：', $title);
  $subtitle = $title[0];
  $subsubtitle = $title[1];


  for ($v=0; $v < count($found_url); $v++) {
    $ary = array();
    $urls = [];

    $ary[] = $subtitle;
    $ary[] = $subsubtitle;
    $ary[] = $found_url[$v][0];


    $urls[$v + 1] = $ary;

    if(!file_exists($file)) {
      touch('urls/data.csv');
      $file = 'urls/data.csv';
    }

    $f = fopen($file, "a");
    if($f) {
      foreach($urls as $line){
        fputcsv($f, $line);
      }
    }
    fclose($f);


  }


  // if(!file_exists($file)) {
  //   mkdir('urls/'.$subtitle);
  //   touch('urls/'.$subtitle.'/'.$subsubtitle.'.csv');
  //   $file = 'urls/'.$subtitle.'/'.$subsubtitle.'.csv';
  // }



  sleep(5);




}




// $f = fopen("data.csv", "w");
// if ( $f ) {
//   foreach($ary as $line){
//     fputcsv($f, $line);
//   }
// }
// fclose($f);