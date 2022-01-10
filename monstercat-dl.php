<?php

use MonstercatDl\CLI\DownloadCommand;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/bootstrap.php';

$app = new Application('mobstercat-dl', '2.0.0');

$app->add(new DownloadCommand());

$app->run();
