<?php

use Boa\App;

$boa = new App();

$settings = $boa->Settings();

require_once __DIR__.'/ErrorHandler/ErrorHandler.php';
require_once __DIR__.'/ErrorHandler/WarningHandler.php';

if ($settings['module_database_pdo']) {
    require_once __DIR__.'/Database/PDODB.php';
}

if ($settings['module_database_postgresql']) {
    require_once __DIR__.'/Database/PostgreSQL.php';
}

if ($settings['module_database_sql']) {
    require_once __DIR__.'/Database/SQL.php';
}

if ($settings['module_email_phpmail']) {
    require_once __DIR__.'/Email/PHPMail.php';
}

if ($settings['module_database_sql']) {
    require_once __DIR__.'/Email/SMTP.php';
}

if ($settings['module_router']) {
    require_once __DIR__.'/Router/Router.php';
}

if ($settings['module_security']) {
    require_once __DIR__.'/Security/Security.php';
}

if ($settings['module_security_encryption']) {
    require_once __DIR__.'/Security/Encryption.php';
}

// To check if Boa is loading correctly, un-comment the line below.
// echo '[BOA] Boa has loaded all enabled modules.';