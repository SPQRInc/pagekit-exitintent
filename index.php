<?php

use Pagekit\Application as App;
use Spqr\Exitintent\Helper\ExitintentHelper;

return [
	
	'name' => 'exitintent',
	
	'type' => 'extension',
	
	'main' => function( $app ) {
	},
	
	'autoload' => [
		'Spqr\\Exitintent\\' => 'src'
	],
	
	'nodes' => [],
	
	'routes' => [
		'/exitintent' => [
			'name'       => '@exitintent',
			'controller' => [
				'Spqr\\Exitintent\\Controller\\ExitintentController'
			]
		],
	],
	
	'menu' => [
		'exitintent'           => [
			'label'  => 'Exit Intent',
			'url'    => '@exitintent',
			'active' => '@exitintent(/*)?',
			'icon'   => 'exitintent:icon.svg'
		],
		'exitintent: settings' => [
			'parent' => 'exitintent',
			'label'  => 'Settings',
			'url'    => '@exitintent/settings',
			'access' => 'exitintent: manage settings'
		]
	],
	
	'permissions' => [
		'exitintent: manage settings' => [
			'title' => 'Manage settings'
		]
	],
	
	'settings' => '@exitintent/settings',
	
	'resources' => [
		'exitintent:' => ''
	],
	
	'config' => [
		'html'    => '',
		'sensitivity'     => 20,
		'aggressive' => false,
		'timer' => 100,
		'expires' => 10,
		'cookiename' => 'exitintent',
		'sitewide' => false
	],
	
	'events' => [
		'boot' => function ($event, $app) {
			$app->subscribe(new ExitintentHelper);
		},
		
		'site' => function( $event, $app ) {
			$app->on(
				'view.content',
				function( $event, $test ) use ( $app ) {
					
					$module = App::module( 'exitintent' );
					$config = $module->config;
					
					$sensitivity     = ( !empty( $config[ 'sensitivity' ] ) ? $config[ 'sensitivity' ] : 20 );
					$aggressive     = ( !empty( $config[ 'aggressive' ] ) ? $config[ 'aggressive' ] : false );
					$timer     = ( !empty( $config[ 'timer' ] ) ? $config[ 'timer' ] : 100 );
					$expires = ( !empty( $config[ 'expires' ] ) ? $config[ 'expires' ] : 10 );
					$cookiename = ( !empty( $config[ 'cookiename' ] ) ? $config[ 'cookiename' ] : 'exitintent' );
					$sitewide = ( !empty( $config[ 'sitewide' ] ) ? $config[ 'sitewide' ] : false );
					
					$options = '';
					if($sensitivity) $options .= "sensitivity: $sensitivity,";
					if($aggressive) $options .= "aggressive: $aggressive,";
					if($timer) $options .= "timer: $timer,";
					if($expires) $options .= "cookieExpire: $expires,";
					if($cookiename) $options .= "cookieName: '$cookiename',";
					if($sitewide) $options .= "sitewide: $sitewide";
					
					
					$script = "ouibounce(document.getElementById('exit-modal'), { $options, callback: function() {		
						var exitmodal = UIkit.modal('#exit-modal');
						exitmodal.show();
						}  
					});";
					
					$app[ 'scripts' ]->add(
						'ouibounce',
						'exitintent:app/assets/ouibounce/build/ouibounce.min.js', ['jquery']
					);
					
					$app['scripts']->add('exitintent', $script, [], 'string');
					
				}
			);
		}
	]
];