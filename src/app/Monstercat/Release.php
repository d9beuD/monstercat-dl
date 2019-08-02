<?php

namespace MonstercatDl\Monstercat;

use \MonstercatDl\Url;

class Release
{
    private $id;
    private $title;
    private $renderedArtists;
    private $status;

    public function __construct(string $catalogId)
    {
        $data = $this->getInfo($catalogId);

        if (sizeof($data) > 0) {
            $this->id = $data['_id'];
            $this->title = $data['title'];
            $this->renderedArtists = $data['renderedArtists'];
        } else {
            echo "Error while gettin $catalogId information: code ${$this->status}" . PHP_EOL;
        }
    }

    /**
     * Get the release information
     * @return Array The release information
     */
    private function getInfo(string $catalogId): Array
    {
        $url = new Url();
        $result = json_decode(
            $url->get("https://connect.monstercat.com/api/catalog/release/$catalogId"),
            true
        );

        $this->status = $url->responseCode();

        if ($url->responseCode() === 200) {
            return $result;
        }

        return [];
    }

    /**
     * Get the release ID
     * @return string The release ID
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the release name
     * @return string The release name
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get the rendered artists
     * @return string Rendered artists
     */
    public function getRenderedArtists(): string
    {
        return $this->renderedArtists;
    }

    /**
     * Get the request status
     * @return int The status
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}
