<?php

namespace Boa\Authentication;

use Boa\App;

class PortalSSO extends App
{
    public function __construct() {
        $Boa = new App();
        $settings = $Boa->Settings();
    }

    public function Authenticate() {

    }
}