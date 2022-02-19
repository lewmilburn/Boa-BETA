<?php

namespace Boa\Database;

use Boa\App;
use mysqli;

class SQL extends App
{
    /**
     * @var mysqli
     */
    private mysqli $connect;

    public function __construct()
    {
        // Construct parent class.
        parent::__construct();

        // Connect to the database.
        global $settings;
        $this->connect = new mysqli($settings['db_hostname'], $settings['db_username'], $settings['db_password'], $settings['db_database'], $settings['db_port'], $settings['db_socket']);

        // Return the conection.
        return $this->connect;
    }

    public function Query($string, $mode = 'NONE') {
        $conn = $this->connect;

        global $settings;
        if ($settings['db_security']) {
            $string = $this->Escape($string);
        }

        $result = $conn->query($string);

        return match ($mode) {
            'NONE' => $result,
            'ALL' => $result->fetch_all(),
            'ALL:ASSOC' => $result->fetch_all(MYSQLI_ASSOC),
            'ALL:NUMERIC' => $result->fetch_all(MYSQLI_NUM),
            'ALL:BOTH' => $result->fetch_all(MYSQLI_BOTH),
            'ASSOC' => $result->fetch_assoc(),
            'ARRAY' => $result->fetch_array(),
            'OBJECT' => $result->fetch_object(),
            'NUMROWS' => $result->num_rows,
            default => '$mode defined incorrectly.',
        };

    }

    public function Escape($string): String {
        return $this->connect->escape_string($string);
    }
}