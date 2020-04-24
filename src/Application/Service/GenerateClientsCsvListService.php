<?php


namespace App\Application\Service;


use App\Domain\Repository\ClientRepository;

class GenerateClientsCsvListService
{
    private ClientRepository $clientRepo1;
    private ClientRepository $clientRepo2;

    public function __construct(ClientRepository $clientRepo1, ClientRepository $clientRepo2)
    {
        $this->clientRepo1 = $clientRepo1;
        $this->clientRepo2 = $clientRepo2;
    }

    public function execute(): array
    {
        $resultSource1 = $this->clientRepo1->all();
        $resultSource2 = $this->clientRepo2->all();

        return array_merge($resultSource1, $resultSource2);
    }
}