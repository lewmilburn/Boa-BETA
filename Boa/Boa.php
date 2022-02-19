<?php

namespace Boa;

class App {

    public function __construct()
    {
        $settings = $this->config();
        require_once 'Modules.php';
    }

    public function config(): array {
        return array (
            // Enabled modules
            'module_database_postgresql' => true,
            'module_database_sql' => true,
            'module_router' => true,
            'module_security' => true,
            'module_security_encryption' => true,
            // Database Settings
            'db_driver' => '',
            'db_hostname' => '',
            'db_username' => '',
            'db_password' => '',
            'db_database' => '',
            'db_charset' => '',
            'db_port' => NULL,
            'db_socket' => NULL,
            'db_security' => true,
            // Security Settings
            'password_hash' => 'PASSWORD_DEFAULT',
            'ip_hash' => 'sha3-512',
            'other_hash' => 'sha3-512'
        );
    }
}