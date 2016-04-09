<?php

namespace Acme;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Helper\Table;

class Command extends SymfonyCommand {

    protected $database;

    public function __construct(DatabaseAdapter $database) {
        $this->database = $database;
        parent::__construct();
    }
    
     public function showTasks($output) {
        
        if( ! $tasks = $this->database->fetchAll('tasks')){
        
            return $output->writeln('<info>No tasks at the moment!</info>');
        }
        
        $tasks = $this->database->fetchAll('tasks');
        
        $table = new Table($output);
        
        $table->setHeaders(['id', 'Description'])
              ->setRows($tasks)
              ->render();
        
    }

}
