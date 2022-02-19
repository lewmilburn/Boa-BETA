<?php

namespace Boa;

class App {

    public array $settings;

    public function Settings(): array {
        return array (
            // Enabled modules
            'module_authentication_portal' => false,
            'module_database_pdo' => false,
            'module_database_postgresql' => false,
            'module_database_sql' => false,
            'module_email_phpmail' => false,
            'module_email_smtp' => false,
            'module_router' => false,
            'module_security' => false,
            'module_security_encryption' => false,
            // Database Settings
            'database_driver' => '',
            'database_hostname' => '',
            'database_username' => '',
            'database_password' => '',
            'database_database' => '',
            'database_charset' => '',
            'database_port' => NULL,
            'database_socket' => NULL,
            'database_security' => true,
            // Security Settings
            'password_hash' => 'PASSWORD_DEFAULT',
            'ip_hash' => 'sha3-512',
            'other_hash' => 'sha3-512',
            // Email

            // Error Handling
            'show_warnings' => true,
            'show_errors' => true,
            'show_fatal_errors' => true
        );
    }

    public function __construct()
    {
        $this->settings = $this->Settings();
        require_once 'Modules.php';
    }
}