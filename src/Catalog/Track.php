<?php

namespace MonstercatDl\Catalog;

class Track
{
    /**
     * The internal Monstercat ID of the track.
     * @var string
     */
    protected string $id;

    /**
     * The ID of the track.
     * @var string
     */
    protected string $trackId;

    /**
     * The title of the track.
     * @var string
     */
    protected string $title;

    /**
     * The artists title of the track.
     * @var string
     */
    protected string $artistsTitle;

    public function __construct(string $releaseId, array $data)
    {
        $this->id = $releaseId;
        $this->trackId = $data['Id'];
        $this->title = $data['Title'];
        $this->artistsTitle = $data['ArtistsTitle'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTrackId(): string
    {
        return $this->trackId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getArtistsTitle(): string
    {
        return $this->artistsTitle;
    }

    public function getFilename(): string
    {
        return "$this->title - $this->artistsTitle.mp3";
    }

    /**
     * Get the stream URL for download.
     */
    public function getDownloadUrl(): string
    {
        return "https://www.monstercat.com/api/release/$this->id/track-stream/$this->trackId";
    }
}