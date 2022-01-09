<?php

namespace MonstercatDl\CLI;

use GuzzleHttp\Client;
use MonstercatDl\Catalog\Release;
use MonstercatDl\Catalog\Track;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This command downloads a track from Monstercat.
 */
class DownloadCommand extends Command
{
    protected function configure()
    {
        $this->setName('download')
            ->setDescription('Downloads a track from Monstercat')
            ->addArgument(
                'releases',
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                'The release IDs to download'
            );
    }

    /**
     * @param ConsoleOutput $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /**
         * @var Release[] $releases
         */
        $releases = [];

        // Gathering releases data
        foreach ($input->getArgument('releases') as $releaseId) {
            $output->writeln("Finding data about $releaseId release...");
            $releases[] = $release = new Release($releaseId);

            $release->printInformation($output);
            $output->writeln('');
        }

        // Downloading tracks
        $client = new Client();

        foreach ($releases as $release) {
            $output->writeln('Downloading tracks from release ' . $release->getTitle() . '...');

            foreach ($release->getTracks() as $key => $track) {
                $this->downloadTrack($output, $client, $release, $track, ($key++));
            }

            $output->writeln('');
        }

        return Command::SUCCESS;
    }

    /**
     * @param ConsoleOutput $output
     */
    public function downloadTrack(OutputInterface $output, Client $client, Release $release, Track $track, int $index)
    {
        $section = $output->section();

        $progress = new ProgressBar($section);
        $progress->minSecondsBetweenRedraws(1 / 25);
        $progress->maxSecondsBetweenRedraws(1 / 25);

        $progress->setPlaceholderFormatterDefinition('current', function (ProgressBar $progress) {
            return $this->formatBytes($progress->getProgress());
        });

        $progress->setPlaceholderFormatterDefinition('max', function (ProgressBar $progress) {
            return $this->formatBytes($progress->getMaxSteps());
        });

        $section->writeln("<info> Downloading</info> $index - " . $track->getTitle());
        $progress->display();

        // Create the directory if it doesn't exist
        $directory = getcwd() . DIRECTORY_SEPARATOR . 'Monstercat';
        $directory .= DIRECTORY_SEPARATOR . $release->getArtistsTitle();
        $directory .= DIRECTORY_SEPARATOR . $release->getTitle();

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $request = $client->request('GET', $track->getDownloadUrl(), [
            'sink' => $directory . DIRECTORY_SEPARATOR . "$index - " . $track->getFilename(),
            'progress' => function ($downloadTotal, $downloadedBytes, $uploadTotal, $uploadedBytes) use ($progress) {
                $progress->setMaxSteps($downloadTotal);
                $progress->setProgress($downloadedBytes);
            },
        ]);

        $progress->clear();
        $section->clear(1);
    }

    /**
     * Format bytes to human readable format
     */
    public function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}