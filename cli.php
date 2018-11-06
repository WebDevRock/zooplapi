<?php

require __DIR__.'/vendor/autoload.php';

use App\Command\ImportZoopla;
use Symfony\Component\Console\Application;

$command = new ImportZoopla();

$app = new Application();
$app->add($command);

$app->run();