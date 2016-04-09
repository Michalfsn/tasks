#! /usr/bin/env php
<?php

use Acme\ShowCommand;
use Acme\DatabaseAdapter;
use Acme\AddCommand;
use Acme\CompleteCommand;
use Symfony\Component\Console\Application;

require 'vendor/autoload.php';

$app = new Application('Task app', '1.0');

try {
    $pdo = new PDO('sqlite:db.sqlite');

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo 'could not connect to the database';
    exit(1);
}

$dbAdapter = new DatabaseAdapter($pdo);

$app->add(new ShowCommand($dbAdapter));

$app->add(new AddCommand($dbAdapter));

$app->add(new CompleteCommand($dbAdapter));

$app->run();

