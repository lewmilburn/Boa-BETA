<?php

namespace Boa\Security;

class Security extends Connect
{
    public function CheckData($data) {
        $db = new SQL("localhost", "database", "pass", "user");
        return $db->mysqli_escape_string($data);
    }
}