<?php

namespace Boa\Security;

use Boa\Connect;
use Boa\Database\SQL;

class Security extends Connect
{
    public function CheckData($data): String {
        $db = new SQL();
        return $db->Escape($data);
    }
}