<?php

namespace Boa\Security;

class Encryption extends Security
{
    public function hash_ip($ip): string
    {
        global $settings;
        return hash($settings['ip_hash'], $ip);
    }

    public function hash($data): string
    {
        global $settings;
        return hash($settings['other_hash'], $data);
    }

    public function hash_password($password): string
    {
        global $settings;
        return password_hash($password,$settings['password_hash']);
    }

    public function verify_password($password): bool
    {
        global $settings;
        return password_verify($password,$settings['password_hash']);
    }
}