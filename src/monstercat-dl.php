<?php

define('APP_NAME', $argv[0]);
define('DESCRIPTION', 'Download Monstercat songs from your Terminal app!');
define('VERSION', '1.0.0');

require_once __DIR__ . '/vendor/autoload.php';

use \MonstercatDl\Monstercat\Release;
use \MonstercatDl\Monstercat\Album;

/**
 * Print this CLI usage
 */
function usage()
{
    echo APP_NAME . ' v' . VERSION . ': ' . PHP_EOL .
    DESCRIPTION . PHP_EOL . PHP_EOL .
    'Usage: ' . APP_NAME . ' [RELEASE_ID]...' . PHP_EOL;
}

function parseArgs($argv){
    array_shift($argv); $o = array();
    foreach ($argv as $a){
        if (substr($a,0,2) == '--'){ $eq = strpos($a,'=');
            if ($eq !== false){ $o[substr($a,2,$eq-2)] = substr($a,$eq+1); }
            else { $k = substr($a,2); if (!isset($o[$k])){ $o[$k] = true; } } }
        else if (substr($a,0,1) == '-'){
            if (substr($a,2,1) == '='){ $o[substr($a,1,1)] = substr($a,3); }
            else { foreach (str_split(substr($a,1)) as $k){ if (!isset($o[$k])){ $o[$k] = true; } } } }
        else { $o[] = $a; } }
    return $o;
}

/**
 * Get album information
 * @param  string $key The release ID
 * @return Array       The album information
 */
function getAlbum(string $key): Array
{
    return json_decode(
        file_get_contents('https://connect.monstercat.com/api/catalog/browse/?albumId='.$key),
        true
    );
}

$args = parseArgs($argv);
$releases = array_filter(
    $args,
    function ($key) { return is_numeric($key); },
    ARRAY_FILTER_USE_KEY
);
$blobs = [];

foreach ($releases as $key => $releaseID) {
    $release = new Release($releaseID);

    if ($release->getStatus() === 200) {
        echo '[FOUND] ' . $release->getTitle() . ' - ' .
        $release->getRenderedArtists() . PHP_EOL;

        $tracks = $release->getTracks();

        foreach ($tracks as $track) {
            $blobs[$track->getFileName()] = $track->getDownloadLink();
            echo ' - ' . $track->getFileName() . PHP_EOL;
        }
    }

    echo PHP_EOL;
}

foreach ($blobs as $name => $url) {
    if (isset($args['without-wget'])) {
        echo "[Downloading] `$name`... ";
        if (
            file_put_contents(
                $name . '.mp3',
                file_get_contents($url)
            )
        ) {
            echo 'Ok' . PHP_EOL;
        } else {
            echo 'FAILED' . PHP_EOL;
        }
    } else {
        exec("wget $url -O \"$name.mp3\"");
    }
}
