<?php

namespace Boa\Database;

use Boa\Connect;
use mysqli;

class SQL extends Connect
{

    /**
     * @var mysqli
     */
    private mysqli $connect;

    public function __construct()
    {
        global $settings;
        $this->connect = new mysqli($settings['db_hostname'], $settings['db_username'], $settings['db_password'], $settings['db_database'], $settings['db_port'], $settings['db_socket']);
        return $this->connect;
    }

    public function Query($string, $mode = 'NONE') {
        $conn = $this->connect;

        $string = $conn->real_escape_string($string);
        $result = $conn->query($string);

        switch ($mode){
            case 'NONE': return $result;
            case 'ALL': return $result->fetch_all();
            case 'ALL:ASSOC': return $result->fetch_all(MYSQLI_ASSOC);
            case 'ALL:NUMERIC': return $result->fetch_all(MYSQLI_NUM);
            case 'ALL:BOTH': return $result->fetch_all(MYSQLI_BOTH);
            case 'ASSOC': return $result->fetch_assoc();
            case 'ARRAY': return $result->fetch_array();
            case 'OBJECT': return $result->fetch_object();
            case 'NUMROWS': return $result->num_rows;
        }

        return '$mode defined incorrectly.';
    }

    public function Escape($string): String {
        return $this->connect->escape_string($string);
    }
}