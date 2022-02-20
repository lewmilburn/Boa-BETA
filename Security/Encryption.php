<?php

/**
 * Boa Encryption Library
 * @author      Lewis Milburn <contact@lewismilburn.com>
 * @license     Apache-2.0 License
 */

namespace Boa\Security;

use Boa\App;

class Encryption extends App
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