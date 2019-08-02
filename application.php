<?php

include './vendor/autoload.php';

use Symfony\Component\Console\Application;
use Command\EncodeCommand;

$application = new Application();

$application->add(new EncodeCommand());

$application->run();