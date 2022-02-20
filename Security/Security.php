<?php

/**
 * Boa Security Library
 * @author      Lewis Milburn <contact@lewismilburn.com>
 * @license     Apache-2.0 License
 */

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