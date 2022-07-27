<?php

namespace Boa\Security;

use Boa\App;

class Hash extends App
{
    /**
     * Holds the settings.
     * @var array|string[]
     */
    public array $settings;

    public function __construct()
    {
        parent::__construct();

        $this->settings = array(
            'password_hash' => 'PASSWORD_DEFAULT',
            'ip_hash' => 'sha3-512',
            'other_hash' => 'sha3-512'
        );
    }

    public function Password_Hash($password): string
    {
        return password_hash($password,$this->settings['password_hash']);
    }

    public function Password_Verify($password): bool
    {
        return password_verify($password,$this->settings['password_hash']);
    }

    public function hash_ip($ip): string
    {
        return hash($this->settings['ip_hash'], $ip);
    }

    public function hash($data): string
    {
        return hash($this->settings['other_hash'], $data);
    }
}