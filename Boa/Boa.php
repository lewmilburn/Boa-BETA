<?php

namespace Boa;

class App {

    public array $settings;

    public function __construct()
    {
        $this->settings = $this->Settings();
        require_once 'Modules.php';
    }

    public function Settings(): array {
        return array (
            // Enabled modules
            'module_database_pdo' => true,
            'module_database_postgresql' => true,
            'module_database_sql' => true,
            'module_email_phpmail' => true,
            'module_email_smtp' => true,
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
            'other_hash' => 'sha3-512',
            // Email

            // Error Handling
            'show_warnings' => true,
            'show_errors' => true,
            'show_fatal_errors' => true
        );
    }

    public function ModuleStatus($module): array
    {
        $status['enabled'] = false;
        switch ($module) {
            case '/Boa/Email/PHPMail':
                if ($this->settings['module_email_phpmail'] == true) { $status['enabled'] = true; }
                else { $status['enabled'] = false; }
                break;
            case '/Boa/Email/SMTP':
                if ($this->settings['module_email_smtp'] == true) { $status['enabled'] = true; }
                else { $status['enabled'] = false; }
                break;
        }
        return $status;
    }
}