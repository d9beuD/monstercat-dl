<?php

namespace MonstercatDl\CLI;

use DateTime;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class SearchCommand extends Command
{
    public function configure()
    {
        $this->setName('search')
            ->setDescription('Search for a track on Monstercat')
            ->setDefinition(new InputDefinition([
                new InputOption('limit', 'l', InputOption::VALUE_OPTIONAL, 'The number of results to return', 50),
                new InputArgument('query', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'The query to search for'),
            ]));
    }

    /**
     * @param ConsoleOutput $output
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Searching for <info>' . implode(' ', $input->getArgument('query')) . '</info>');

        // Search for releases
        $client = new Client();
        $response = $client->request('GET', 'https://www.monstercat.com/api/releases', [
            'query' => [
                'search' => implode(' ', $input->getArgument('query')),
                'limit' => $input->getOption('limit'),
            ],
        ]);

        // Check request status
        if ($response->getStatusCode() !== 200) {
            $output->writeln('<error>' . $response->getReasonPhrase() . '</error>');
            return Command::FAILURE;
        }

        // Parse data
        $data = json_decode($response->getBody()->getContents(), true);

        // Reduce data to only the fields we need
        $reduced = array_reduce($data['Releases']['Data'], function ($carry, $item) {
            $carry[] = [
                $item['CatalogId'],
                $item['ArtistsTitle'],
                $item['Title'],
                $item['Type'],
                (new DateTime($item['ReleaseDate']))->format('Y-m-d'),
                $item['GenrePrimary'] . ', ' . $item['GenreSecondary'],
            ];

            return $carry;
        }, []);

        // Create the table
        $table = new Table($output);
        $table->setHeaderTitle('Releases');
        $table->setHeaders([
            'ID (' . count($reduced) . ')', 
            'Artists', 
            'Title', 
            'Type',
            'Release Date',
            'Genre',
        ]);
        $table->setColumnMaxWidth(1, 20);
        $table->setRows($reduced);
        $table->setStyle('box');
        $table->render();

        return Command::SUCCESS;
    }
}