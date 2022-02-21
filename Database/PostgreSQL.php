<?php

/**
 * Boa PostgreSQL Library
 * @author      Lewis Milburn <contact@lewismilburn.com>
 * @license     Apache-2.0 License
 */

namespace Boa\Database;
use Boa\App;

class PostgreSQL extends App
{
    public array $settings;

    public function __construct()
    {
        global $settings;
        // Settings
        $settings =  array (
            'database_driver' => '',
            'database_hostname' => '',
            'database_username' => '',
            'database_password' => '',
            'database_database' => '',
            'database_charset' => '',
            'database_port' => NULL,
            'database_socket' => NULL,
            'database_security' => true,
        );
    }
}