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
    public function __construct() {
        parent::__construct();
        $Boa = new App();
        $settings = $Boa->Settings();
    }

    public function Authenticate() {

    }
}