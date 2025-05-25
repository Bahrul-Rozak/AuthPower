#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use AuthPower\Migrations\CreateUsersTable;
use AuthPower\Seeders\UserSeeder;
use AuthPower\Migrations\CreatePasswordResetsTable;

$argv = $_SERVER['argv'];

if (!isset($argv[1])) {
    echo "AuthPower CLI - available commands:\n";
    echo "  migrate        Run database migrations\n";
    echo "  make:user      Create dummy user\n";
    exit(0);
}

switch ($argv[1]) {
    case 'migrate':
        CreateUsersTable::up();
        CreatePasswordResetsTable::up();
        break;
    case 'make:user':
        UserSeeder::run();
        break;
    default:
        echo "Command not found\n";
}
