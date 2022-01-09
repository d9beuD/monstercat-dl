<?php

namespace MonstercatDl\Catalog;

use GuzzleHttp\Client;
use Symfony\Component\Console\Output\OutputInterface;

class Release
{
    /**
     * The catalog ID of the release.
     * @var string
     */
    protected string $catalogId;

    /**
     * The artists title of the release
     * @var string
     */
    protected string $artistsTitle;

    /**
     * The internal Monstercat ID of the release.
     * @var string
     */
    protected string $id;

    /**
     * The title of the release.
     * @var string
     */
    protected string $title;

    /**
     * The list of tracks found in the release
     * @var Track[]
     */
    protected array $tracks = [];

    public function __construct(string $catalogId)
    {
        $this->catalogId = $catalogId;
        $this->init();
    }

    protected function init()
    {
        $client = new Client();
        $response = $client->request('GET', "https://www.monstercat.com/api/catalog/release/$this->catalogId");
        $data = json_decode($response->getBody()->getContents(), true);

        $this->artistsTitle = $data['Release']['ArtistsTitle'];
        $this->id = $data['Release']['Id'];
        $this->title = $data['Release']['Title'];

        // Get the tracks
        foreach ($data['Tracks'] as $track) {
            $this->tracks[] = new Track($this->id, $track);
        }
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getArtistsTitle(): string
    {
        return $this->artistsTitle;
    }

    /**
     * @return Track[]
     */
    public function getTracks(): array
    {
        return $this->tracks;
    }

    public function printInformation(OutputInterface $output)
    {
        $output->writeln("<info>Release name:</info> $this->title");

        foreach ($this->tracks as $key => $track) {
            $key += 1;
            $output->writeln("<info> Track $key:</info> " . $track->getTitle());
        }
    }
}