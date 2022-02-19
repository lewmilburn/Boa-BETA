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

        $dsn = "mysql:host=".$settings['db_hostname'].";dbname=".$settings['db_database'].";charset=".$settings['db_charset'];
        $this->pdodb = new PDO($dsn);
    }

    public function Query($string, $driver = 'NONE') {

    }

    public function Prepare($string) {

    }
}