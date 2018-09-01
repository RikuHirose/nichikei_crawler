<?php
require_once __DIR__ . '/vendor/autoload.php';

$cli = new Goutte\Client();

//file
$file = array();
foreach(glob('/Users/rikuparkour1996/www/scraping/urls/data.csv') as $file){
  if(is_file($file)){
    $file = htmlspecialchars($file);
  }
}


//csvを配列に変換
$csv  = array();
$fp   = fopen($file, "r");

while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
  $csv[] = $data;
}
fclose($fp);

$html = array();
for ($i=0; $i < count($csv); $i++) {
  $ary = array();
  $html = [];
  $url = 'http://www.eco.nihon-u.ac.jp/about/disclosure/syllabus_2018/'.$csv[$i][2];

  $conn = curl_init(); // cURLセッションの初期化
  curl_setopt($conn, CURLOPT_URL, $url); //取得するURLを指定
  curl_setopt($conn, CURLOPT_RETURNTRANSFER, true); // 実行結果を文字列で返す。
  $res =  curl_exec($conn);


  $ary[] = $csv[$i][0];
  $ary[] = $csv[$i][1];
  $ary[] = $res;

  $html[] = $ary;




  if(!file_exists($file)) {
    touch('html/'.$csv[$i][0].'.csv');
    $file = 'html/'.$csv[$i][0].'.csv';

  } else if(file_exists($file) && $file === $csv[$i][0].'csv') {
    $file = $file;

  } else if(file_exists($file) && $file !== $csv[$i][0].'csv') {
    touch('html/'.$csv[$i][0].'.csv');
    $file = 'html/'.$csv[$i][0].'.csv';
  }

  $f = fopen($file, "a");
  if($f) {
    foreach($html as $line){
      fputcsv($f, $line);
    }
  }
  fclose($f);
  curl_close($conn);

  sleep(5);
}





