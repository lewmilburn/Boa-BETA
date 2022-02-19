<?php

global $settings;

if ($settings['module_database_postgresql']) {
    require_once __DIR__.'/Database/PostgreSQL.php';
}

if ($settings['module_database_sql']) {
    require_once __DIR__.'/Database/SQL.php';
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