<?php

namespace Boa;

class App {

    public function __construct()
    {
        $settings = $this->config();
    }

    public function config(): array {
        return array (
            'db_hostname' => '',
            'db_username' => '',
            'db_password' => '',
            'db_database' => '',
            'db_port' => NULL,
            'db_socket' => NULL,
            'db_security' => true
        );
    }
}