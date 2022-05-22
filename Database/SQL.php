<?php

/**
 * Boa SQL Library
 * @author      Lewis Milburn <contact@lewismilburn.com>
 * @license     Apache-2.0 License
 */

namespace Boa\Database;

use Boa\App;
use mysqli;
use mysqli_result;

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

        // Settings
        $this->settings = array (
            'database_driver' => '',
            'database_hostname' => 'localhost',
            'database_username' => 'root',
            'database_password' => '',
            'database_database' => 'feedback',
            'database_charset' => '',
            'database_port' => NULL,
            'database_socket' => NULL,
            'database_security' => true,
        );

        // Connect to the database.
        $this->connect = new mysqli($this->settings['database_hostname'], $this->settings['database_username'], $this->settings['database_password'], $this->settings['database_database'], $this->settings['database_port'], $this->settings['database_socket']);

        // Return the connection.
        return $this->connect;
    }

    public function Query($query, $mode = 'NONE') {
        if ($this->settings['database_security']) {
            $string = $this->Escape($query);
        }

        $conn = $this->connect;
        $result = $conn->query($query);

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

    public function Select($select, $from, $where = '1', $mode = 'NONE') {
        if ($this->settings['database_security']) {
            $select = $this->Escape($select);
            $from = $this->Escape($from);
        }

        $conn = $this->connect;
        $result = $conn->query("SELECT `$select` FROM `$from` WHERE $where;");

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

    public function Insert($table, $items, $values): mysqli_result|bool
    {
        if ($this->settings['database_security']) {
            $table = $this->Escape($table);
            $items = $this->Escape($items);
            //$values = $this->Escape($values);
        }

        $conn = $this->connect;
        return $conn->query("INSERT INTO `$table` ($items) VALUES ($values);");
    }

    public function Update($table, $set, $where): mysqli_result|bool
    {
        if ($this->settings['database_security']) {
            $table = $this->Escape($table);
            $where = $this->Escape($where);
        }

        $conn = $this->connect;
        return $conn->query("UPDATE '$table' SET $set WHERE $where;");
    }

    public function Delete($table, $where): mysqli_result|bool
    {
        if ($this->settings['database_security']) {
            $table = $this->Escape($table);
            $where = $this->Escape($where);
        }

        $conn = $this->connect;
        return $conn->query("DELETE FROM '$table' WHERE $where;");
    }

    public function Escape($string): String {
        return $this->connect->escape_string($string);
    }
}