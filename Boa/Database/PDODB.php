<?php

namespace Boa\Database;

use Boa\App;
use PDO;

class PDODB extends App
{
    /**
     * @var PDO
     */
    private PDO $pdodb;

    public function __construct()
    {
        // Construct parent class.
        parent::__construct();

        // Connect to the database.
        $Boa = new App();
        $settings = $Boa->Settings();

        $dsn = "mysql:host=".$settings['database_hostname'].";dbname=".$settings['database_database'].";charset=".$settings['database_charset'];
        $this->pdodb = new PDO($dsn);
    }

    public function Query($string, $driver = 'NONE') {
        return null;
    }

    public function Prepare($string) {
        return null;
    }
}