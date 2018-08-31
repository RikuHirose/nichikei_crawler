<?php

require_once __DIR__ . '/vendor/autoload.php';

$cli = new Goutte\Client();
$url = 'http://www.eco.nihon-u.ac.jp/about/disclosure/syllabus_2018/AB00022.html';
$crawler = $cli->request('GET',$url);

// url リスト取得
$urls = $crawler->filter('#main .teachersList li a')->extract('href');
