<?php


namespace App\Command;


use App\Application\GenerateClientsCsvListService;
use App\Infrastructure\Domain\Repository\JsonClientRepository;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ObtainCsvFileCommand extends Command
{
    protected static $defaultName = 'bodas:obtain-users';

    private const RESULT_CSV_FILENAME = 'ClientList.csv';

    private GenerateClientsCsvListService $generateClientsCsvListService;

    // THIS WOULD BE A BETTER APPROACH (with dependency injection)
    //public function __construct(GenerateClientsCsvListService $generateClientsCsvListService)
    //{
    //    $this->generateClientsCsvListService = $generateClientsCsvListService;
    //    parent::__construct();
    //}

    protected function configure(): void
    {
        $this->addArgument('xmlFile', InputArgument::REQUIRED);

        $this->generateClientsCsvListService = new GenerateClientsCsvListService(
            new JsonClientRepository(new Client())
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('xmlFile');
        $xmlClientData = file_get_contents($filename);

        $clientArray = $this->generateClientsCsvListService->execute($xmlClientData);

        $this->storeResultToCsv($clientArray);
    }

    private function storeResultToCsv(array $clientArray): void
    {
        $fp = fopen(self::RESULT_CSV_FILENAME, 'w');
        $header = array('name', 'email', 'phone', 'companyName');
        fputcsv($fp, $header);
        foreach ($clientArray as $client) {
            fputcsv($fp, $client);
        }
        fclose($fp);
    }
}