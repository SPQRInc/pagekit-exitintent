<?php

use Doctrine\DBAL\Schema\Comparator;
use Pagekit\Application as App;

return [
    
    /*
     * Installation hook
     *
     */
    'install'   => function ($app) {
    },
    
    /*
     * Enable hook
     *
     */
    'enable'    => function ($app) {
    },
    
    /*
     * Uninstall hook
     *
     */
    'uninstall' => function ($app) {
        
        // remove the config
        $app[ 'config' ]->remove('spqr/exitintent');
    },
    
    /*
     * Runs all updates that are newer than the current version.
     *
     */
    'updates'   => [
        '1.0.2' => function ($app) {
            $app['config']->set('spqr/exitintent', $app->config('exitintent')->toArray());
            $app['config']->remove('exitintent');
        }
    ],

];