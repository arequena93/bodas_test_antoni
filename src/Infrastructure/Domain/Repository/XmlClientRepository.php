<?php


namespace App\Infrastructure\Domain\Repository;


use App\Domain\Repository\ClientRepository;

class XmlClientRepository implements ClientRepository
{
    public function all(): array
    {
        $xmlFromFile = $this->getXmlFromFile();

        $xmlData = simplexml_load_string($xmlFromFile);
        $clientArray = array();
        foreach($xmlData as $client) {
            $clientArray[] = array(
                (string) $client->attributes()['name'],
                (string) $client,
                (string) $client->attributes()['phone'],
                (string) $client->attributes()['company']
            );
        }

        return $clientArray;
    }

    private function getXmlFromFile()
    {
        return file_get_contents(__DIR__ . '/../../../../data.xml');
    }
}