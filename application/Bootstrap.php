<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    function _initRequiredLibs() {
        // Define our library directory
        $libDir = APPLICATION_PATH."/../library/";

        // Read the contents
        $handle = opendir($libDir);
        $count = 0;
        while ($contents[] = readdir($handle)) {
            $count++;
        }

        // Unset the uneeded
        unset($contents[0]);
        unset($contents[1]);
        unset($contents[$count]);

        // Do our require
        foreach ($contents as $filename) {
            if ($filename != 'Zend') {
                require_once $libDir.$filename;
            }
        }
    }
}

