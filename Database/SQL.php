<?php

namespace Boa\Database;

use Boa\Connect;
use mysqli;

class SQL extends Connect
{

    /**
     * @var mysqli
     */
    private $connect;

    public function __construct($hostname, $database, $username, $password, $port = null, $socket = null)
    {
        $this->connect = new mysqli($hostname, $username, $password, $database, $port, $socket);
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
}