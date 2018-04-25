<?php


const RED = "\033[01;31m";
const RESET = "\033[0m";

function makeSheetData($worksheet) {
  $ret = [];

  foreach ($worksheet->getRowIterator() as $row) {
    $ret[] = [];

    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);

    foreach ($cellIterator as $cell) {
      $ret[count($ret)-1][] = trim($cell->getValue());
    }
  }

  // filter out empty rows.
  return array_filter($ret, function($row) { return $row !== []; });
}

function autoSizeColumns($worksheet) {
  for ($col = 'A'; $col <= 'Z'; $col++) {
    $worksheet->getColumnDimension($col)->setAutoSize(true);
  }
}

// Parses an excel file and returns a 2D array
// of all the cells. Empty rows are *not* returned.
//
// Note that only the *first* worksheet of the excel file is parsed.
function excelFileToArray($filename) {
  $objReader = PHPExcel_IOFactory::createReaderForFile($filename);
  $objReader->setReadDataOnly(true);

  $worksheet = $objReader->load($filename)->getActiveSheet();

  return makeSheetData($worksheet);
}

// Replaces the last occurence of $search with $replace in string $subject
function str_last_replace($subject, $search, $replace) {
  $pos = strrpos($subject, $search);

  if ($pos) {
      $subject = substr_replace($subject, $replace, $pos, strlen($search));
  }

  return $subject;
}

// Prevents continuation until the user
// correctly enters the 'pass' phrase.
function userInputGate($displayMsg, $pass) {
  echo $displayMsg;
  echo "\n";

  $handle = fopen ("php://stdin","r");

  do {
    echo "Type '$pass' to continue: ";
    $line = fgets($handle);
  } while (trim($line) != $pass);

  fclose($handle);
}

// Converts "minutes-since-midnight" to 12hr formatt
function minutes2Time($mins) {
  $d = new DateTime('00:00');
  $d->modify('+'.$mins.' minutes');

  return $d->format('h:i A');
}

// Generates and returns a list of all the dates between
// start and start+numDays (inclusive) in the format of YYYYMMDD
function generateDates($start, $numDays) {
  $d = new DateTime();
  $ret = [];

  foreach (range(0, $numDays) as $n) {
    $ret[] = $d->format('Ymd');
    $d->modify('+ 1 days');
  }

  return implode($ret, ',');
}

// Returns the values corresponding to the given key from
// the input 2D array.
function getValuesByKey($array, $key) {
  $ret = array_map(function($row) use ($key) {
    return $row[$key];
  }, $array);

  return $ret;
}


///////////////////
// Logging
///////////////////
function error_msg($msg, $log=false) {
  $m = 'ERROR: ' . $msg . PHP_EOL;
  echo $m;

  if ($log) { log_msg($m); }
}

function info_msg($msg, $log=false) {
  $m = 'INFO: ' . $msg . PHP_EOL;
  echo $m;

  if ($log) { log_msg($m); }
}

function abort_msg($msg, $log=false) {
  $m = 'ABORT: ' . $msg . PHP_EOL;
  echo $m;

  if ($log) { log_msg($m); }

  exit(-7);
}

function log_msg($msg) {
  file_put_contents('./log_'.date("m.d.Y").'.txt', $msg, FILE_APPEND);
}