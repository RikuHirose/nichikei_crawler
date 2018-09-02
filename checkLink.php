<?php
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
  $url = 'http://www.eco.nihon-u.ac.jp/about/disclosure/syllabus_2018/'.$csv[$i][2];
  $response = @file_get_contents($url, NULL, NULL, 0, 1);
  if ($response === false) {
      echo $url;
  }
  sleep(3);
}


