<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\EntityManagerInterface;

// replace with file to your own project bootstrap
require_once __DIR__ . '/bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
global $entityManager;

return ConsoleRunner::createHelperSet($entityManager);