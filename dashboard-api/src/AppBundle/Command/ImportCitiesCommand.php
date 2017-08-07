<?php

namespace AppBundle\Command;

use AppBundle\Import\CityImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCitiesCommand extends Command
{
    private $importer;

    public function __construct(CityImporter $importer)
    {
        $this->importer = $importer;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('dashboard:import-cities')
            ->setDescription('Imports cities with their zip code and INSEE code.')
            ->addArgument('filepath', InputArgument::REQUIRED)
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $filePath = $input->getArgument('filepath');
        $nbImported = $this->importer->importFile($filePath);

        $output->writeln(sprintf('<info>%d cities were imported</info>', $nbImported));
    }
}
