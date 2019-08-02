<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Firebase\JWT\JWT;

class JwtEncodeCommand extends Command
{
    protected static $defaultName = 'jwt:encode';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setDescription('Encode payload')
            ->addArgument('payload', InputArgument::REQUIRED, 'Payload to encode')
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
        $privateKeyPath = $input->getArgument('private') ?? '/home/mmarchwiany/.ssh/tiqets';
        $payload = $input->getArgument('payload');

        $privateKey = file_get_contents($privateKeyPath);

        $encoded = JWT::encode($payload, $privateKey, 'RS256');

        $output->writeln($encoded);
    }
}
