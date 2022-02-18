<?php

namespace Boa\Security;

use Boa\App;
use Boa\Database\SQL;

class Security extends App
{
    public function CheckData($data): String {
        $db = new SQL();
        return $db->Escape($data);
    }
}