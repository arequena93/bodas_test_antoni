<?php


namespace App\UI\Controller;


use App\Application\GenerateClientsCsvListService;

class ClientController
{
    private GenerateClientsCsvListService $generateClientsCsvListService;

    public function __construct(GenerateClientsCsvListService $generateClientsCsvListService)
    {
        $this->generateClientsCsvListService = $generateClientsCsvListService;
    }

    public function getList()
    {
        $this->generateClientsCsvListService->execute();
    }
}