<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__DIR__) . '/vendor/autoload.php';

use mstroink\SmartMeter\SmartMeter;

// Read P1 from file
$config = ['input' => dirname(__DIR__) . '/tests/' . 'raw-4.0.txt'];
/** @var SmartMeter $smartMeter */
$SmartMeter = SmartMeter::configure('file', $config);
print_r($SmartMeter->read());

// // Read P1 from script
$config = ['input' => '/home/pi/smart_meter/docs/meter.py'];
/** @var SmartMeter $smartMeter*/
$SmartMeter = SmartMeter::configure('script', $config);
// print_r($SmartMeter->read());