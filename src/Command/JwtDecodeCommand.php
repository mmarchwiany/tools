<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Firebase\JWT\JWT;

class JwtDecodeCommand extends Command
{
    protected static $defaultName = 'jwt:decode';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setDescription('Decode payload')
            ->addArgument('payload', InputArgument::REQUIRED, 'Payload to decode')
            ->addArgument('public', InputArgument::OPTIONAL, 'Public key path');
    }

    /**
     * Execute command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $publicKeyPath = $input->getArgument('public') ?? '~/.ssh/id_rsa.pub';
        $payload = $input->getArgument('payload');

        $publicKey = file_get_contents($publicKeyPath);

        $decoded = JWT::decode($payload, $publicKey, array('RS256'));

        $output->writeln(json_encode($decoded));
    }
}
