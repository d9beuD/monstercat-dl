<?php

namespace MonstercatDl\Monstercat;

class Music
{
    private $title;
    private $artist;
    private $album;
    private $hash;

    public function __construct(string $title, string $artist, string $album, string $hash)
    {
        $this->title = $title;
        $this->artist = $artist;
        $this->album = $album;
        $this->hash = $hash;
    }

    /**
     * Get the file name to save the music to
     * @return string The file name
     */
    public function getFileName(): string
    {
        return "$this->artist - $this->title";
    }

    /**
     * Get the download link from the stream hash
     * @return string The download link
     */
    public function getDownloadLink(): string
    {
        return "https://blobcache.monstercat.com/blobs/$this->hash";
    }
}
