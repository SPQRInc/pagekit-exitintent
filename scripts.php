<?php

use Doctrine\DBAL\Schema\Comparator;

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
        '1.0.1' => function ($app) {
            $app['config']->set('spqr/exitintent', $app->config('exitintent')->toArray());
            $app['config']->remove('exitintent');
        }
    ],

];