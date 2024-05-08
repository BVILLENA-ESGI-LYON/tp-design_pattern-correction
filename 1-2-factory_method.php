<?php

declare(strict_types=1);

use EsgiIw\TpDesignPattern\Factory\Alert\Login\LoginAlertToAdminEmailFactory;
use EsgiIw\TpDesignPattern\Factory\Alert\Login\LoginAlertToDatabaseFactory;
use EsgiIw\TpDesignPattern\Factory\Alert\Login\LoginAlertToLogFactory;

require_once 'vendor/autoload.php';

$connectedUser = uniqid(prefix: 'etudiant-');
echo "# Connexion utilisateur « {$connectedUser} »";

echo "\n\n";

echo "## 1. Alerte dans les fichiers de log\n";
$logFileLoginAlert = new LoginAlertToLogFactory();
$logFileLoginAlert->alertForLogin($connectedUser);

echo "\n\n";

echo "## 2. Alerte en base de données\n";
$logDatabaseLoginAlert = new LoginAlertToDatabaseFactory();
$logDatabaseLoginAlert->alertForLogin($connectedUser);

echo "\n\n";

echo "## 3. Alerte par mail\n";
$logAdminEmailLoginAlert = new LoginAlertToAdminEmailFactory();
$logAdminEmailLoginAlert->alertForLogin($connectedUser);
