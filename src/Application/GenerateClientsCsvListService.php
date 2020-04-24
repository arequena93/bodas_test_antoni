<?php


namespace App\Application;


use App\Domain\Service\ClientRepository;

class GenerateClientsCsvListService
{
    private ClientRepository $clientRepo;

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    public function execute(string $xmlData): array
    {
        $resultSource1 = $this->clientRepo->all();

        $xmlData = simplexml_load_string($xmlData);
        $resultSource2 = array();
        foreach($xmlData as $client) {
            $resultSource2[] = array(
                (string) $client->attributes()['name'],
                (string) $client,
                (string) $client->attributes()['phone'],
                (string) $client->attributes()['company']
            );
        }

        return array_merge($resultSource1, $resultSource2);
    }
}