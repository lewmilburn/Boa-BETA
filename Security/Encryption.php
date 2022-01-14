<?php

namespace Boa\Security;

class Encryption extends Security
{
    public function hash_ip($ip): string
    {
        return hash('sha3-512', $ip);
    }

    public function hash($data): string
    {
        return hash('sha3-512', $data);
    }
}