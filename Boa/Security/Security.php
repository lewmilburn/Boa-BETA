<?php

namespace Boa\Security;

use Boa\App;
use Boa\Database\SQL;

class Security extends App
{
    public function database_input($data): string {
        $db = new SQL();
        return $db->Escape($data);
    }

    public function input($data): string
    {
        return 'null';
    }
}