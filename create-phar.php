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
$p = new Phar($pharFile, 0, 'monstercat-dl.phar');
$p->setSignatureAlgorithm(\Phar::SHA1);
$p->startBuffering();

// Creating our library using whole directory
$p->buildFromDirectory('src/');

// Create default stub
$defaultStub = $p->createDefaultStub('monstercat-dl.php');
$stub = "#!/usr/bin/env php\n" . $defaultStub;
$p->setStub($stub);

$p->stopBuffering();
// Plus - compressing it into gzip
$p->compress(Phar::GZ);

echo "$pharFile successfully created";
