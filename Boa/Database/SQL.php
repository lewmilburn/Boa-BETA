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
    public array $settings;

    public function __construct()
    {
        // Construct parent class.
        parent::__construct();
        $Boa = new App();
        $settings = $Boa->Settings();

        // Connect to the database.
        $this->connect = new mysqli($this->settings['db_hostname'], $this->settings['db_username'], $this->settings['db_password'], $this->settings['db_database'], $this->settings['db_port'], $this->settings['db_socket']);

        // Return the conection.
        return $this->connect;
    }

    public function Query($string, $mode = 'NONE') {
        $conn = $this->connect;

        if ($this->settings['db_security']) {
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