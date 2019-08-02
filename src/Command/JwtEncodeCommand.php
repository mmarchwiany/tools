<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Firebase\JWT\JWT;

class JwtEncodeCommand extends Command
{
    protected static $defaultName = 'encode';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setDescription('Encode payload')
            ->addArgument('payload', InputArgument::REQUIRED, 'Payload to encode')
            ->addArgument('public', InputArgument::OPTIONAL, 'Public key path')
            ->addArgument('private', InputArgument::OPTIONAL, 'Private key path');
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
        $publicKeyPath = $input->getArgument('public') ?? '/home/mmarchwiany/.ssh/tiqets.pub';
        $privateKeyPath = $input->getArgument('public') ?? '/home/mmarchwiany/.ssh/tiqets';
        $payload = $input->getArgument('payload');

        $privateKey = file_get_contents($privateKeyPath);
        $publicKey = file_get_contents($publicKeyPath);

        $encoded = JWT::encode($payload, $privateKey, 'RS256');
        $decoded = JWT::decode($encoded, $publicKey, array('RS256'));

        $output->writeln("\n<info>Encoded data:</info>");
        $output->writeln($encoded);
        $output->writeln("\n<info>Decoded data:</info>");
        $output->writeln($decoded);
    }
}
