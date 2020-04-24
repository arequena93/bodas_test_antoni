<?php

use App\Command\ObtainCsvFileCommand;
use Symfony\Component\Console\Application;

require dirname(__DIR__).'/vendor/autoload.php';

$application = new Application();

$application->add(new ObtainCsvFileCommand());

$application->run();


