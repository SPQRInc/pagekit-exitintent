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
		'html'        => '',
		'sensitivity' => 20,
		'aggressive'  => false,
		'timer'       => 100,
		'expires'     => 10,
		'cookiename'  => 'exitintent',
		'sitewide'    => false
	],
	
	'events' => [
		'boot' => function( $event, $app ) {
			$app->subscribe( new ExitintentHelper );
		},
		
		'site' => function( $event, $app ) {
			$app->on(
				'view.content',
				function( $event, $test ) use ( $app ) {
					
					$module = App::module( 'exitintent' );
					$config = $module->config;
					
					$options = [];
					
					if ( $sensitivity =
						( array_key_exists( 'sensitivity', $config ) ? $config[ 'sensitivity' ] : false )
					) {
						$options[] = "sensitivity: $sensitivity";
					}
					if ( $aggressive =
						( array_key_exists( 'aggressive', $config ) ? $config[ 'aggressive' ] : false )
					) {
						$options[] = "aggressive: true";
					}
					if ( $timer = ( array_key_exists( 'timer', $config ) ? $config[ 'timer' ] : 100 ) ) {
						$options[] = "timer: $timer";
					}
					if ( $expires = ( array_key_exists( 'expires', $config ) ? $config[ 'expires' ] : 10 ) ) {
						$options[] = "cookieExpire: $expires";
					}
					if ( $cookiename =
						( array_key_exists( 'cookiename', $config ) ? $config[ 'cookiename' ] : 'exitintent' )
					) {
						$options[] = "cookieName: '$cookiename'";
					}
					if ( $sitewide = ( array_key_exists( 'sitewide', $config ) ? $config[ 'sitewide' ] : false ) ) {
						$options[] = "sitewide: $sitewide";
					}
					
					$options = implode( ",", $options );
					
					$script = "ouibounce(document.getElementById('exit-modal'), { $options, callback: function() {		
						var exitmodal = UIkit.modal('#exit-modal');
						exitmodal.show();
						}  
					});";
					
					$app[ 'scripts' ]->add(
						'ouibounce',
						'exitintent:app/assets/ouibounce/build/ouibounce.min.js',
						[ 'jquery' ]
					);
					
					$app[ 'scripts' ]->add( 'exitintent', $script, [], 'string' );
					
				}
			);
		}
	]
];