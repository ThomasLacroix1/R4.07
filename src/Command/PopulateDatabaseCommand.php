<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Lego;

#[AsCommand(
    name: 'app:populate-database',
    description: 'Add a short description for your command',
)]
class PopulateDatabaseCommand extends Command
{
    private $service;

    public function __construct(EntityManagerInterface $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('json', InputArgument::REQUIRED, 'Argument description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $json = $input->getArgument('json');
        $arg1 = file_get_contents(__DIR__ . '/../Data/' . $json);
        $arg1 = (json_decode($arg1, true));

        // dd($arg1);

        foreach ($arg1 as $el){
            $l = new Lego($el['id'], $this->service);
            $l->setName($el['name']);
            $l->setDescription($el['description']);
            $l->setPrice($el['price']);
            $l->setPieces($el['pieces']);
            $l->setBoxImage($el['images']['box']);
            $l->setLegoImage($el['images']['bg']);
            
            $this->service->persist($l);
            $this->service->flush();
        }
        

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
