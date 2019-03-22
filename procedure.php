<?php

require_once __DIR__ . '/vendor/autoload.php';

require('helpers/urls.php');
require('helpers/index.php');
require('helpers/getRound.php');

class scraping
{
  private $cli;
  private $year;
  private $lesson_last_id;
  private $lesson_shedule_last_id;

  function first($year, $cli)
  {
    getUrls($year, $cli);
  }

  function second($year, $cli, $lesson_last_id)
  {
    getLessonData($year, $cli, $lesson_last_id);
  }

  function third($year, $cli, $lesson_last_id, $lesson_shedule_last_id)
  {
    getLessonSchedules($year, $cli, $lesson_last_id, $lesson_shedule_last_id);
  }
}

$year = 2019;
$lesson_last_id = 1392;
$lesson_shedule_last_id = 31860;


$cli = new Goutte\Client();
$scr = new scraping;

// $scr->first($year, $cli);
// $scr->second($year, $cli);
$scr->third($year, $cli, $lesson_last_id, $lesson_shedule_last_id);

