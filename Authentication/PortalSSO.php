<?php

/**
 * Boa Portal SSO Library
 * @author      LMWN <contact@lmwn.co.uk>
 * @license     Apache-2.0 License
 */

namespace Boa\Authentication;

use Boa\App;

class PortalSSO extends App
{
    public array $settings;

    public function __construct() {
        parent::__construct();
        global $settings;
        $settings = parent::Settings();
    }

    public function Authenticate() {

    }
}