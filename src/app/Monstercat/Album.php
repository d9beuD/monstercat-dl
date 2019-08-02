<?php

namespace MonstercatDl\Monstercat;

use \MonstercatDl\Url;

class Album
{
    private $musics = [];
    private $title;
    private $status;

    public function __construct(string $albumId, string $title)
    {
        $this->title = $title;
        $data = $this->getInfo($albumId);

        if ($this->status === 200) {
            foreach ($data['results'] as $music) {
                $this->musics[] = new Music(
                    $music['title'],
                    $music['artistsTitle'],
                    $title,
                    $music['albums']['streamHash']
                );
            }
        } else {
            echo "Error while gettin `$title` information: code ${$this->status}" . PHP_EOL;
        }
    }

    /**
     * Get album information
     * @param  string $albumId The album ID
     * @return Array           The album information
     */
    private function getInfo(string $albumId): Array
    {
        $url = new Url();
        $result = json_decode(
            $url->get("https://connect.monstercat.com/api/catalog/browse/?albumId=$albumId"),
            true
        );

        $this->status = $url->responseCode();

        if ($url->responseCode() === 200) {
            return $result;
        }

        return [];
    }

    /**
     * Get all musics in this album
     * @return Array [description]
     */
    public function getMusics(): Array
    {
        return $this->musics;
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
