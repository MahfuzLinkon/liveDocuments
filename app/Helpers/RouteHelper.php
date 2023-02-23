<?php

namespace App\Helpers;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class RouteHelper
{
    public static function includeRouteFiles(string $folder){
        // iterate through the route api version folder
        $dirIterator = new RecursiveDirectoryIterator($folder);
        /**
         * @var RecursiveDirectoryIterator | RecursiveIteratorIterator $it
         *
         */
        $it = new RecursiveIteratorIterator($dirIterator);
        // require the file each iteration
        while ($it->valid()){
            if (!$it->isDot()
                && $it->isFile()
                && $it->isReadable()
                && $it->current()->getExtension() === 'php'){
                require $it->key();
//                require $it->current()->getPathname();
            }
            $it->next();
        }
    }
}
