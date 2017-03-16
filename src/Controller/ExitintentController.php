<?php

namespace Spqr\Exitintent\Controller;

use Pagekit\Application as App;

/**
 * @Access(admin=true)
 */
class ExitintentController
{
	/**
	 * @return mixed
	 */
	public function indexAction()
	{
		return App::response()->redirect( '@exitintent/settings' );
	}
	
	/**
	 * @Access("exitintent: manage settings")
	 */
	public function settingsAction()
	{
		$module = App::module( 'exitintent' );
		$config = $module->config;
		
		return [
			'$view' => [
				'title' => __( 'Exitintent Settings' ),
				'name'  => 'exitintent:views/admin/settings.php'
			],
			'$data' => [
				'config' => App::module( 'exitintent' )->config()
			]
		];
	}
	
	/**
	 * @Request({"config": "array"}, csrf=true)
	 * @param array $config
	 *
	 * @return array
	 */
	public function saveAction( $config = [] )
	{
		App::config()->set( 'exitintent', $config );
		
		return [ 'message' => 'success' ];
	}
	
}