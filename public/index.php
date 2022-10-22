<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

chdir(__DIR__.'/..');

require 'vendor/autoload.php';

require 'src/app.php';
