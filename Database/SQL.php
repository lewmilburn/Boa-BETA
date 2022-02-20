<?php

/**
 * Boa SQL Library
 * @author      Lewis Milburn <contact@lewismilburn.com>
 * @license     Apache-2.0 License
 */

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

        global $settings;
        $settings = parent::Settings();

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

    public function Select($select, $table, $mode = 'NONE') {
        if ($this->settings['database_security']) {
            $select = $this->Escape($select);
            $table = $this->Escape($table);
        }

        $conn = $this->connect;
        $result = $conn->query("SELECT '$select' FROM '$table';");

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

    public function Insert($into, $values) {
        if ($this->settings['database_security']) {
            $into = $this->Escape($into);
            $values = $this->Escape($values);
        }

        $conn = $this->connect;
        return $conn->query("INSERT INTO '$into' VALUES ($values);");
    }

    public function Update($table, $set, $where) {
        if ($this->settings['database_security']) {
            $table = $this->Escape($table);
            $where = $this->Escape($where);
        }

        $conn = $this->connect;
        return $conn->query("UPDATE '$table' SET $set WHERE $where;");
    }

    public function Delete($table, $where) {
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