<?php

namespace App\Helpers\Routes;


class RouteHelper
{
    public static function includeRouteFiles(string $folder)
    {
        //iterate through directory v1 recursively
        $dirIterator = new \RecursiveDirectoryIterator($folder);
        /** @var \RecursiveDirectoryIterator | \RecursiveIteratorIterator $it */
        $it = new \RecursiveIteratorIterator($dirIterator);
        //require the file in each iteration
        //valid هترجع ترو طول ما في كونتنت بتشاور عليه
        while ($it->valid()) {
            if (!$it->isDot() // continue if it not directory
                && $it->isFile()
                && $it->isReadable()
                && $it->current()->getExtension() === 'php') {
                require $it->key();
                //require $it->current()->getPathname();
                //two methods do same thing
            }
            $it->next();
        }
    }
}
