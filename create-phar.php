<?php

$pharFile = 'monstercat-dl.phar';

// Clean up
if (file_exists($pharFile)) {
    unlink($pharFile);
}
if (file_exists($pharFile . '.gz')) {
    unlink($pharFile . '.gz');
}

// Create phar
$p = new Phar($pharFile);

// Creating our library using whole directory
$p->buildFromDirectory('src/');

// Pointing main file which requires all classes
$p->setDefaultStub('monstercat-dl.php', '/monstercat-dl.php');

// Plus - compressing it into gzip
$p->compress(Phar::GZ);

echo "$pharFile successfully created";
