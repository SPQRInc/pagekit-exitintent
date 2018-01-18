<?php

use Pagekit\Application as App;
use Spqr\Exitintent\Helper\ExitintentHelper;

return [
    
    'name' => 'spqr/exitintent',
    
    'type' => 'extension',
    
    'main' => function ($app) {
    },
    
    'autoload' => [
        'Spqr\\Exitintent\\' => 'src',
    ],
    
    'nodes' => [],
    
    'routes' => [],
    
    'menu' => [],
    
    'permissions' => [],
    
    'settings' => 'exitintent-settings',
    
    'resources' => [
        'spqr/exitintent:' => '',
    ],
    
    'config' => [
        'nodes'       => [],
        'html'        => '',
        'sensitivity' => 20,
        'aggressive'  => false,
        'timer'       => 100,
        'expires'     => 10,
        'cookiename'  => 'exitintent',
        'sitewide'    => false,
    ],
    
    'events' => [
        'boot'         => function ($event, $app) {
            $app->subscribe(new ExitintentHelper);
        },
        'site'         => function ($event, $app) {
            $app->on('view.content', function ($event, $test) use ($app) {
                if ((!$this->config['nodes']
                    || in_array($app['node']->id, $this->config['nodes']))
                ) {
                    $module  = App::module('spqr/exitintent');
                    $config  = $module->config;
                    $options = [];
    
                    if ($sensitivity = (array_key_exists('sensitivity', $config)
                        ? $config['sensitivity'] : false)
                    ) {
                        $options[] = "sensitivity: $sensitivity";
                    }
                    if ($aggressive = (array_key_exists('aggressive', $config)
                        ? $config['aggressive'] : false)
                    ) {
                        $options[] = "aggressive: true";
                    }
                    if ($timer = (array_key_exists('timer', $config)
                        ? $config['timer'] : 100)
                    ) {
                        $options[] = "timer: $timer";
                    }
                    if ($expires = (array_key_exists('expires', $config)
                        ? $config['expires'] : 10)
                    ) {
                        $options[] = "cookieExpire: $expires";
                    }
                    if ($cookiename = (array_key_exists('cookiename', $config)
                        ? $config['cookiename'] : 'exitintent')
                    ) {
                        $options[] = "cookieName: '$cookiename'";
                    }
                    if ($sitewide = (array_key_exists('sitewide', $config)
                        ? $config['sitewide'] : false)
                    ) {
                        $options[] = "sitewide: $sitewide";
                    }
                    
                    $options = implode(",", $options);
    
                    $script
                        = "ouibounce(document.getElementById('exit-modal'), { $options, callback: function() {
						var exitmodal = UIkit.modal('#exit-modal');
						exitmodal.show();
						}
					});";
    
                    $app['scripts']->add('spqr/ouibounce',
                        'spqr/exitintent:app/assets/ouibounce/ouibounce.min.js',
                        ['jquery']);
                    $app['scripts']->add('spqr/exitintent', $script, [],
                        'string');
                }
            });
        },
        'view.scripts' => function ($event, $scripts) use ($app) {
            $scripts->register('exitintent-settings',
                'spqr/exitintent:app/bundle/exitintent-settings.js',
                ['~extensions', 'vue', 'input-tree', 'editor']);
        },
    ],
];