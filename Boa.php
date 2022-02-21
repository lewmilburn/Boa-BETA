<?php

/**
 * Boa - The simple, fast and reliable PHP Framework.
 * @author      Lewis Milburn <contact@lewismilburn.com>
 * @license     Apache-2.0 License
 */

namespace Boa;

use Exception;

class App {

    public array $settings;

    public function Settings(): array {
        return array (
            // Error Handling
            'show_warnings' => true,
            'show_errors' => true,
            'show_fatal_errors' => true,
        );
    }

    public function __construct()
    {
        $this->settings = $this->Settings(); // Register settings
        $this->Autoload(); // Register modules
    }

    public function Autoload() {
        // Get modules list
        $modulesJSON = file_get_contents(__DIR__ . '/modules.json');
        $modulesJSON = json_decode($modulesJSON);
        $i=1;
        // Loop through the modules.
        foreach ($modulesJSON as $module) {
            try {
                // If enabled, load 'em up!
                if ($module->enabled == 'true') {
                    include __DIR__ . '/' . $module->module;
                }
                // On to the next one...
                $i++;
            } catch(Exception) {
                // Oh dear... moving on.
                $i++;
            }
        }
    }

    public function Modules() {
        $modulesJSON = file_get_contents(__DIR__ . '/modules.json');
        return json_decode($modulesJSON);
    }
}