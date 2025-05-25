#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

// Placeholder for CLI commands
echo "AuthPower CLI - available commands:\n";
echo "  migrate        Run database migrations\n";
echo "  make:user      Create dummy user\n";

$argv = $_SERVER['argv'];
if (!isset($argv[1])) {
    exit(0);
}

switch ($argv[1]) {
    case 'migrate':
        echo "Running migrations...\n";
        break;
    case 'make:user':
        echo "Creating dummy user...\n";
        break;
    default:
        echo "Command not found\n";
}
