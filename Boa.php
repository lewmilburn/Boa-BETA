<?php

namespace Boa;

class Connect
{
    public string $settings;

    public function __construct()
    {
        global $settings;
        $settings = array (
            'db_hostname' => '',
            'db_username' => '',
            'db_password' => '',
            'db_database' => '',
            'db_port' => NULL,
            'db_socket' => NULL
        );
    }
}