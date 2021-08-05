<?php

namespace App\Console;

use App\Application\Actions\Import\importAction;
use App\Infrastructure\Persistence\Reference\MappedProperties;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ImportCommand extends Command
{
    private LoggerInterface $logger;
    private importAction $action;

    public function __construct(
        LoggerInterface $logger,
        importAction $action
    )
    {
        parent::__construct(null);
        $this->logger = $logger;
        $this->action = $action;
    }

    protected function configure(): void
    {
        parent::configure();

        $this->setName('import');
        $this->setDescription('Команда для импорта товаров');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->action->import();


        return 0;
    }
}