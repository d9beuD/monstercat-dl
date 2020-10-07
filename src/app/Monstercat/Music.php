<?php

namespace MonstercatDl\Monstercat;

class Music
{
    private $title;
    private $artist;
    private $releaseId;
    private $trackId;

    public function __construct(string $title, string $artist, string $releaseId, string $trackId)
    {
        $this->title = $title;
        $this->artist = $artist;
        $this->releaseId = $releaseId;
        $this->trackId = $trackId;
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
        return "https://connect.monstercat.com/v2/release/$this->releaseId/track-stream/$this->trackId";
    }
}
