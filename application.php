<?php

include './vendor/autoload.php';

use Symfony\Component\Console\Application;
use Command\JwtEncodeCommand;
use Command\JwtDecodeCommand;

$application = new Application();

$application->add(new JwtEncodeCommand());
$application->add(new JwtDecodeCommand());

$application->run();
