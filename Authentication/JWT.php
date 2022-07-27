<?php

namespace Boa\Authentication;

use Boa\App;

/**
 * Boa JavaScript Web Token Library
 * @author      Lewis Milburn <contact@lewismilburn.com>
 * @license     Apache-2.0 License
 */
class JWT extends App
{
    /**
     * The super-secret key.
     * @var string
     */
    private string $key;

    /**
     * Stores the type of JWT to be created. Usually 'JWT'.
     * @var string
     */
    private string $type;

    /**
     * Stores the algorithm to be used. Usually 'SHA-512'.
     * @var string
     */
    private string $algorithm;

    /**
     * Constructs the class.
     * @param string $key
     * @param string $type
     * @param string $algorithm
     */
    public function __construct(string $key, string $type = 'JWT', string $algorithm = 'HS512')
    {
        parent::__construct();

        $this->key = $key;
        $this->type = $type;
        $this->algorithm = $algorithm;
    }

    /**
     * Generates a JWT
     * @param string $payload
     * @return string
     */
    public function Generate(string $payload): string
    {
        $header = $this->GenerateHeader();
        $payload = $this->GeneratePayload($payload);
        $signature = $this->GenerateSignature($header, $payload);

        return $header . '.' . $payload . '.' . $signature;
    }

    /**
     * Generates the header part of the token.
     * Uses settings preset during construction.
     * @return string
     */
    private function GenerateHeader(): string
    {
        $header = '{"alg": "'.$this->algorithm.'", "typ": "'.$this->type.'"}';

        return $this->EncodeData($header);
    }

    /**
     * Generates the payload part of the token.
     * @param string $payload
     * @return string
     */
    private function GeneratePayload(string $payload): string
    {
        return $this->EncodeData($payload);
    }

    /**
     * Generates the signature part of the token.
     * @param string $header
     * @param string $payload
     * @return string
     */
    private function GenerateSignature(string $header, string $payload): string {
        $algorithm = match ($this->algorithm) {
            'HS256' => 'sha256',
            default => 'sha512'
        };

        $data = $header . '.' . $payload;

        return hash_hmac($algorithm, $data, $this->key);
    }

    /**
     * Checks that the token is valid.
     * @param string $token
     * @return bool
     */
    public function Validate(string $token): bool
    {
        $algorithm = match ($this->algorithm) {
            'HS256' => 'sha256',
            default => 'sha512'
        };

        $Token = explode('.', $token);

        if (!array_keys($Token) == 3) {
            return false;
        }

        $Header = $Token[0];
        $Payload = $Token[1];

        $data = $Header . '.' . $Payload;

        if (hash_hmac($algorithm, $data, $this->key) === $Token[2]) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Encode data to Base64URL
     * @param string $data
     * @return boolean|string
     */
    private function EncodeData(string $data): bool|string
    {
        $b64 = base64_encode($data);
        if (!$b64) {
            return false;
        }
        $url = strtr($b64, '+/', '-_');
        return rtrim($url, '=');
    }

    /**
     * Fetches the data within a token.
     * @param string $token
     * @return array
     */
    public function GetData(string $token): array
    {
        $Token = explode('.', $token);

        $Data[0] = $this->DecodeData($Token[0]);
        $Data[1] = $this->DecodeData($Token[1]);

        return $Data;
    }

    /**
     * Decode data from Base64URL
     * @param string $data
     * @param boolean $strict
     * @return boolean|string
     */
    private function DecodeData(string $data, bool $strict = false): bool|string
    {
        $b64 = strtr($data, '-_', '+/');
        return base64_decode($b64, $strict);
    }
}