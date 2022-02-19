<?php

namespace Boa;

class App {

    public function __construct()
    {
        $settings = $this->config();
    }

    public function config(): array {
        return array (
            // Database Settings
            'db_hostname' => '',
            'db_username' => '',
            'db_password' => '',
            'db_database' => '',
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