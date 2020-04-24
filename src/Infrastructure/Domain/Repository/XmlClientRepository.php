<?php


namespace App\Infrastructure\Domain\Repository;


use App\Domain\Service\ClientRepository;
use GuzzleHttp\ClientInterface;

class XmlClientRepository implements ClientRepository
{
    private ClientInterface $guzzleInterface;
    private const GOOGLEDRIVE_CLIENTS_URL = 'https://drive.google.com/file/d/1i605leyfJx5Jke-H7aiCr1MsEd2OePxW/view?usp=sharing';

    public function __construct(ClientInterface $guzzleInterface)
    {
        $this->guzzleInterface = $guzzleInterface;
    }

    public function all(): array
    {
        $gDriveResponse = $this->jsonPlaceHolderDoGet(self::GOOGLEDRIVE_CLIENTS_URL);

        /*$gDriveContent = \json_decode($gDriveResponse->getBody()->getContents(),
       true,
       512,
       JSON_THROW_ON_ERROR);*/

        var_dump($gDriveResponse->getBody()->getContents());
        die;
        return array();
    }

    private function jsonPlaceHolderDoGet(string $url)
    {
        return $this->guzzleInterface->request('GET', $url);
    }
}