<?php

namespace Friendica\Directory\Routes\Web;

use Friendica\Directory\Controllers\Web\BaseController;

/**
 * @author Hypolite Petovan <hypolite@mrpetovan.com>
 */
abstract class BaseRoute
{
	/**
	 * @var \Slim\Container
	 */
	protected $container;

	/**
	 * @var BaseController
	 */
	protected $controller;

	public function __construct(\Slim\Container $container)
	{
		$this->container = $container;
	}

	public function __invoke(\Slim\Http\Request $request, \Slim\Http\Response $response, array $args): \Slim\Http\Response
	{
		$defaults = [
			'pages'       => glob(__DIR__ . '/../../../../config/pages/*.html'),
			'version'     => file_get_contents(__DIR__ . '/../../../../VERSION'),
			'languages'   => $this->container->settings['i18n']['locales'],
			'lang'        => $request->getAttribute('locale'),
			'baseUrl'     => $request->getUri()->getBaseUrl(),
			'content'     => '',
			'noNavSearch' => false
		];

		$values = $this->controller->render($request, $response, $args);

		$values = $values + $defaults;

		// Render index view
		return $this->container->renderer->render($response, 'layout.phtml', $values);
	}
}
