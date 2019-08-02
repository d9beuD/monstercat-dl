<?php

define('APP_NAME', $argv[0]);
define('DESCRIPTION', 'Download Monstercat songs from your Terminal app!');
define('VERSION', '1.0.0');

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
 * Get release information
 * @param  string $key The release key on Monstercat website
 * @return Array       The release information
 */
function getRelease(string $key): Array
{
    return json_decode(
        file_get_contents(
            "https://connect.monstercat.com/api/catalog/release/$key"
        ),
        true
    );
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

if ($argc > 1) {
    $albums = [];

    foreach ($argv as $key => $value) {
        if ($key > 0) {
            $albums[] = $value;
        }
    }

    foreach ($albums as $key => $albumKey) {
        $release = getRelease($albumKey);
        $album = getAlbum($release['_id']);

        foreach ($album['results'] as $key => $music) {
            exec("wget https://blobcache.monstercat.com/blobs/{$music['albums']['streamHash']} -O {$music['albums']['streamHash']}.mp3");
        }
    }
} else {
    usage();
    exit(1);
}
