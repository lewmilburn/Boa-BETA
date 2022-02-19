<?php

namespace Boa\ErrorHandler;

class ErrorHandler
{
    public function Error($message) {
        global $settings;

        if($settings['show_errors']) {
            echo '[BOA > Error]: ' . $message;
        }
    }

    public function ErrorFatal($message) {
        global $settings;

        if($settings['show_fatal_errors']) {
            echo '[BOA > Fatal Error]: ' . $message;
            exit;
        }
    }
}