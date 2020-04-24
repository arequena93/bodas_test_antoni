<?php


namespace App\Infrastructure\Domain\Repository;


use App\Domain\Entity\Client;
use App\Domain\Repository\ClientRepository;
use GuzzleHttp\ClientInterface;

class JsonClientRepository implements ClientRepository
{
    private ClientInterface $guzzleInterface;
    private const JSONPLACEHOLDER_CLIENTS_URL = 'https://jsonplaceholder.typicode.com/users';

    public function __construct(ClientInterface $guzzleInterface)
    {
        $this->guzzleInterface = $guzzleInterface;
    }

    public function all(): array
    {
        $jsonPlaceholderResponse = $this->jsonPlaceHolderDoGet(self::JSONPLACEHOLDER_CLIENTS_URL);

        $jsonPlaceholderContent = \json_decode($jsonPlaceholderResponse->getBody()->getContents(),
        true,
        512,
        JSON_THROW_ON_ERROR);

        $clientArray = array();
        foreach ($jsonPlaceholderContent as $clientItem) {
            $clientArray[] = array($clientItem['name'], $clientItem['email'], $clientItem['phone'], $clientItem['company']['name']);
            //$clientArray[] = new Client($clientItem['name'], $clientItem['email'], $clientItem['phone'], $clientItem['company']['name']);
        }

        return $clientArray;
    }

    private function jsonPlaceHolderDoGet(string $url)
    {
        return $this->guzzleInterface->request('GET', $url);
    }
}